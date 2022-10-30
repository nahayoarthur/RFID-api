#include<SPI.h>
#include<ESP8266WiFi.h>// nodeMcU library
#include<ESP8266HTTPClient.h>// post and get methods 
#include<MFRC522.h> // RFID libraries
#include <WiFiClient.h>

WiFiClient wifiClient;
 
#define RST_sous D3
#define sda_pin D4
MFRC522 rfid_object(sda_pin,RST_sous);
const char* ssid="iPhone";
const char* password="66669999";
String cardId="";
String name="";
void setup()
{
  Serial.begin(115200);
  SPI.begin();
  rfid_object.PCD_Init();
  WiFi.begin(ssid,password);
  while(WiFi.status() !=WL_CONNECTED)
  {
    Serial.print(".");
    delay(1000);
    }
    Serial.println("Wifi connection established ");
    Serial.println(WiFi.localIP());
    delay(500);
  }
  void loop()
  {
   if(WiFi.status() == WL_CONNECTED)
   {
      if(!rfid_object.PICC_IsNewCardPresent())
      {
        return;
        }
        if(!rfid_object.PICC_ReadCardSerial())
        { return;
          }
          for(byte i=0;i<rfid_object.uid.size;i++ )
          {
          cardId+=rfid_object.uid.uidByte[i];
            }
            //Serial.println(cardId);
          // call API function 
             if(cardId=="16916224498")
             {
              name ="Honoline";      
             }else{
              name="";
             } 
             rfidlog(cardId,name);   
    }
    cardId="";
  }
  void rfidlog(String cardnumber,String username)
  {
    HTTPClient http;// create object for post or get method
    String postdata="card_id="+cardnumber+"&usern="+username+"&action=insertdata";
//    specify the path to push data
    http.begin(wifiClient,"http://172.20.10.3/IOT/db.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int httpcode=http.POST(postdata);
    if(httpcode==HTTP_CODE_OK)
    {
      String payload=http.getString();
      Serial.println(payload);// receive the payload
      }
      else
      {
        Serial.println("Data not sent");
        Serial.println("ApI Fails");
        }
}
