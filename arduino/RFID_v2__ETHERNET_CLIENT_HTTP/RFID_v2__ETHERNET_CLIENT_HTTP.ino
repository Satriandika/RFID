#include <ArduinoJson.h> //6.17.3
#include <Ethernet.h>
#include <MFRC522.h>
#include <SPI.h>
#include <Servo.h>

// replace the MAC address below by the MAC address printed on a sticker on the
// Arduino Shield 2
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xEC};

EthernetClient client;

int HTTP_PORT = 80;
String HTTP_METHOD = "GET";
char HOST_NAME[] = "192.168.1.128"; // change to your PC's IP address
String PATH_NAME = "/RFID/action-data-api.php";
String getData;
String uidString;
Servo myservo;

#define SS_PIN 9
#define RST_PIN 8
#define buzzer 7
int pinIR = 6;
int pinServo = 3;
int pinR = 2;
int pinY = 4;
int pinG = 5;
int r_prev = 0;
String tol = "srengseng";
int gateState = 0;

MFRC522 mfrc522(SS_PIN, RST_PIN); // Create MFRC522 instance.

const char *tanggal_dibaca;
const char *harga;
const char *saldo;
const char *status_transaksi;
const char *nama_dibaca;

void buzzeroke() {
  digitalWrite(buzzer, HIGH);
  delay(100);
  digitalWrite(buzzer, LOW);
  delay(100);
  digitalWrite(buzzer, HIGH);
  delay(100);
  digitalWrite(buzzer, LOW);
  delay(100);
}

void buzzergagal() {
  digitalWrite(buzzer, HIGH);
  delay(850);
  digitalWrite(buzzer, LOW);
  delay(80);
}

int isRising(int input) {
  int res = 0;
  if (input == 1 and r_prev == 0) {
    res = 1;
  }
  r_prev = input;
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
  Serial.print("Message : ");
  uidString.toUpperCase();
  Serial.println(uidString);
  digitalWrite(buzzer, HIGH);
  delay(100);
  digitalWrite(buzzer, LOW);

  return true;
}

void httpRequest() {
  // POST TO WEB
  client.connect(HOST_NAME, HTTP_PORT);
  String payload = HTTP_METHOD + " " + PATH_NAME +
                   "?rfid=" + String(uidString) + "&tol=" + tol +
                   //"&sensor2=" + String(sensor2) +
                   " HTTP/1.1";
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
  Serial.println("response=" + getData);

  // AMBIL DATA JSON
  const size_t capacity =
      JSON_OBJECT_SIZE(5) +
      110; // cari dulu nilainya pakai Arduino Json 5 Asisten
  DynamicJsonDocument doc(capacity);
  // StaticJsonDocument<192> doc;
  DeserializationError error = deserializeJson(doc, getData);

  tanggal_dibaca = doc["tanggal"];
  harga = doc["harga"];
  saldo = doc["saldo"];
  status_transaksi = doc["status_transaksi"];
  nama_dibaca = doc["nama"];

  // PRINT TO SERIAL
  Serial.println("Waktu = " + String(tanggal_dibaca));
  Serial.println("Harga = " + String(harga));
  Serial.println("Saldo = " + String(saldo));
  Serial.println("Status Transaksi = " + String(status_transaksi));
  Serial.println("Nama = " + String(nama_dibaca));
}

void setup() {
  Serial.begin(115200);
  pinMode(buzzer, OUTPUT);
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
}

void loop() {
  // Baca data
  int bacaIR = !digitalRead(pinIR);
  int rising = isRising(bacaIR);
  if (rising) {
    Serial.println("rising");
  }

  if (gateState == 0 && readRFID()) {
    httpRequest();
    // LOGIKA
    if (String(status_transaksi) != "Berhasil") {
      buzzergagal();
      if (String(status_transaksi) == "RFID tidak dikenal") {
        Serial.println("RFID TIDAK DIKENAL");

      } else if (String(status_transaksi) == "Tol tidak dikenal") {
        Serial.println("TOL TIDAK TERDAFTAR");

      } else if (String(status_transaksi) == "Saldo kurang") {
        Serial.println("SALDO TIDAK CUKUP");
      } else {
        Serial.println("TRANSAKSI GAGAL");
      }
    } else {
      buzzeroke();
      gateState = 1;
      myservo.write(0);

      Serial.println("Kartu Terdaftar!");
      Serial.println("Silahkan Masuk");

      setLampu(0, HIGH, 0);
      delay(100);
      setLampu(0, 0, HIGH);
    }
  } else if(gateState == 1 && rising == 1) {
    myservo.write(90);
    setLampu(HIGH,0,0);
    Serial.println("Tempelkan kartu");
    gateState = 0;
  }

  client.clearWriteError();
  client.flush();
  // delay(1000);
}