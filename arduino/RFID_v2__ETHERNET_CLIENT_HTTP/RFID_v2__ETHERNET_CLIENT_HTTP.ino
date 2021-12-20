#include <ArduinoJson.h> //6.17.3
#include <Ethernet.h>
#include <MFRC522.h>
#include <SPI.h>
#include <Servo.h>
#include <NewPing.h>

// replace the MAC address below by the MAC address printed on a sticker on the
// Arduino Shield 2
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xEC};

EthernetClient client;

int HTTP_PORT = 80;
char HTTP_METHOD[] = "GET";
char HOST_NAME[] = "192.168.1.128"; // change to your PC's IP address
char data_path[] = "/RFID/action-data-api.php";
char screen_path[] = "/RFID/action-screen-api.php";
char endH[] = "\r\n\r\n";
String getData;
String uidString;
Servo myservo;

#define SS_PIN 9
#define RST_PIN 8
#define pinBuzzer 7
// int pinIR = 6;
int pinServo = A2; // orange
int pinR = 2; // coklat
int pinY = 4; // hitam
int pinG = 5; // putih
int pinTrigger = A4; // biru
int pinEcho = A3; // ungu
int r_prev = 0;
const size_t inp_buff_size = 20;
int inp_buff[inp_buff_size] = {0};
int falling_pattern[inp_buff_size] = {0};
String tol = "srengseng";

int gateState = 0;
int BATAS = 20;

MFRC522 mfrc522(SS_PIN, RST_PIN); // Create MFRC522 instance.

// Ultrasonik
NewPing cm(pinTrigger, pinEcho, BATAS);

// body response json
// const char *tanggal_dibaca;
// const char *harga;
// const char *saldo;
const char *status_transaksi;
// const char *nama_dibaca;

void buzzeroke() {
  digitalWrite(pinBuzzer, HIGH);
  delay(100);
  digitalWrite(pinBuzzer, LOW);
  delay(100);
  digitalWrite(pinBuzzer, HIGH);
  delay(100);
  digitalWrite(pinBuzzer, LOW);
  delay(100);
}

void buzzOne() {
  digitalWrite(pinBuzzer, HIGH);
  delay(100);
  digitalWrite(pinBuzzer, LOW);
}

void buzzergagal() {
  digitalWrite(pinBuzzer, HIGH);
  delay(850);
  digitalWrite(pinBuzzer, LOW);
  delay(80);
}

int ultraTreshold(int input, int max) {
  if (input >= max || input == 0) {
    return 0;
  } else {
    return 1;
  }
}

void printArray(size_t size, int arr[]) {
  for (size_t i = 0; i < size; i++)
  {
    Serial.print(String(arr[i]) + ",");
  }
  Serial.println();
}

void pushBuffer(size_t size, int inp_buff[], int input) {
  // shift 1
  for (size_t i = size - 1; i > 0; i--)
  {
    inp_buff[i] = inp_buff[i-1];
  }
  // push
  inp_buff[0] = input;
}

bool checkPattern(size_t size, int inp_buff[], int pattern[]){
  for (size_t i = 0; i < size; i++)
  {
    if(inp_buff[i] != pattern[i]) {
      return false;
    }
  }
  return true;
}

int isFalling(int input) {
  int res = 0;
  // printArray(inp_buff_size, inp_buff);
  pushBuffer(inp_buff_size, inp_buff, input);
  if (checkPattern(inp_buff_size, inp_buff, falling_pattern)) {
    res = 1;
  }
  return res;
}

void setLampu(int r, int y, int g) {
  digitalWrite(pinR, r);
  digitalWrite(pinY, y);
  digitalWrite(pinG, g);
}

bool readRFID() {
  // Program yang akan dijalankan berulang-ulang
  if (!mfrc522.PICC_IsNewCardPresent()) {
    return false;
  }
  // Select one of the cards
  if (!mfrc522.PICC_ReadCardSerial()) {
    return false;
  }
  uidString = "";
  // Show UID on serial monitor
  Serial.print("UID tag :");
  byte letter;
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    uidString.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""));
    uidString.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  uidString.toUpperCase();
  Serial.println(uidString);
  buzzOne();
  return true;
}

void httpRequest(String path, String body) {
  // POST TO WEB
  client.connect(HOST_NAME, HTTP_PORT);
  String payload = String(HTTP_METHOD) + " " + path + body + " HTTP/1.1";
  Serial.println("payload=" + payload);
  client.println(payload);
  client.println("Host: " + String(HOST_NAME));
  client.println("Connection: close");
  client.println(); // end HTTP header

  while (client.connected()) {
    if (client.available()) {
      char endH[] = "\r\n\r\n";
      client.find(endH);
      getData = client.readString();
      getData.trim();
    }
  }

  Serial.println("size=" + String(getData.length()) + "response=" + getData);
}

void sendPayment(String rfid, String tol) {
  String body = "?rfid=" + rfid + "&tol=" + tol;
  httpRequest(data_path, body);

  // AMBIL DATA JSON
  const size_t capacity =
      JSON_OBJECT_SIZE(5) +
      110; // cari dulu nilainya pakai Arduino Json 5 Asisten
  DynamicJsonDocument doc(capacity);
  // StaticJsonDocument<192> doc;
  DeserializationError error = deserializeJson(doc, getData);

  // tanggal_dibaca = doc["tanggal"];
  // harga = doc["harga"];
  // saldo = doc["saldo"];
  status_transaksi = doc["status_transaksi"];
  // nama_dibaca = doc["nama"];

  // PRINT TO SERIAL
  // Serial.println("Waktu = " + String(tanggal_dibaca));
  // Serial.println("Harga = " + String(harga));
  // Serial.println("Saldo = " + String(saldo));
  Serial.println("Status Transaksi = " + String(status_transaksi));
  // Serial.println("Nama = " + String(nama_dibaca));
}

void sendInfo(String status_gerbang, String message) {
  String body = "?status_gerbang=" + status_gerbang + "&message=" + message;
  httpRequest(screen_path, body);
}

void setup() {
  Serial.begin(9600);
  pinMode(pinBuzzer, OUTPUT);
  pinMode(pinR, OUTPUT);
  pinMode(pinY, OUTPUT);
  pinMode(pinG, OUTPUT);
  myservo.attach(pinServo);

  while (!Serial)
    ;

  SPI.begin();        // Initiate  SPI bus
  mfrc522.PCD_Init(); // Initiate MFRC522

  // START IP DHCP
  Serial.println("Konfigurasi DHCP, Silahkan Tunggu!");
  if (Ethernet.begin(mac) == 0) {
    Serial.println("DHCP Gagal!");
    if (Ethernet.hardwareStatus() == EthernetNoHardware) {
      Serial.println("Ethernet Tidak tereteksi :(");
    } else if (Ethernet.linkStatus() == LinkOFF) {
      Serial.println("Hubungkan kabel Ethernet!");
    }
    while (true) {
      delay(1);
    }
  }
  // End DHCP
  delay(1000);
  Serial.print("IP address: ");
  Serial.println(Ethernet.localIP());
  client.connect(HOST_NAME, HTTP_PORT);
  Serial.println("Siap Digunakan!");

  setLampu(HIGH, 0, 0);
  myservo.write(90);
  falling_pattern[inp_buff_size - 1] = 1;
  falling_pattern[inp_buff_size - 2] = 1;
  falling_pattern[inp_buff_size - 3] = 1;
}

void loop() {
  // Baca data
  // int bacaIR = !digitalRead(pinIR);
  int bacaUltras = cm.ping_cm();
  Serial.println("us=" + String(ultraTreshold(bacaUltras, 15)));
  int falling = isFalling(ultraTreshold(bacaUltras, 15));
  // printArray(inp_buff_size, inp_buff);
  if (falling) {
    Serial.println("falling");
  }

  if (gateState == 0 && readRFID()) {
    sendPayment(uidString, tol);
    // LOGIKA
    if (String(status_transaksi) != "1") {
      buzzergagal();
      if (String(status_transaksi) == "3") {
        Serial.println("RFID TIDAK DIKENAL");

      } else if (String(status_transaksi) == "4") {
        Serial.println("TOL TIDAK TERDAFTAR");

      } else if (String(status_transaksi) == "5") {
        sendInfo("Ditutup", "2");
        Serial.println("SALDO TIDAK CUKUP");
      } else {
        Serial.println("TRANSAKSI GAGAL");
      }
    } else {
      gateState = 1;
      sendInfo("Dibuka", "1");

      setLampu(0, HIGH, 0);
      delay(300);
      setLampu(0, 0, HIGH);
      buzzeroke();
      myservo.write(0);
      Serial.println("Kartu Terdaftar!");
      Serial.println("Silakan Masuk");

    }
  } else if (gateState == 1 && falling == 1) {
    sendInfo("Ditutup", "0");
    buzzOne();
    gateState = 0;
    setLampu(HIGH, 0, 0);
    myservo.write(90);
    Serial.println("Tempelkan kartu!");
  }

  client.clearWriteError();
  client.flush();
  // delay(1000);
}