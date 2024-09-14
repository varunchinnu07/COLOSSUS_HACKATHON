// Include necessary libraries
#define BLYNK_TEMPLATE_NAME "Varun D C"
#define BLYNK_AUTH_TOKEN "msGBHiYKsZdsQkK9dF-hz1Q7aOJ6IQZ1"
#define BLYNK_TEMPLATE_ID "TMPL3QEsLnjDP"
#include <ESP8266WiFi.h>
#include <BlynkSimpleEsp8266.h>

// Blynk Auth Token
char auth[] = "msGBHiYKsZdsQkK9dF-hz1Q7aOJ6IQZ1";

// Wi-Fi credentials
const char* ssid = "realme";        
const char* password = "123456789";  

// GPIO pin assignments
#define TRIG_PIN D1          // Trigger pin of ultrasonic sensor
#define ECHO_PIN D2          // Echo pin of ultrasonic sensor
#define RELAY_PIN D5         // Relay control pin
#define BUZZER_PIN D6        // Buzzer control pin
#define SOIL_MOISTURE_PIN A0 // Soil moisture sensor

BlynkTimer timer;
bool notificationSent = false;  // Flag to track if notification was already sent

// Function to read the ultrasonic sensor distance
long readUltrasonicDistance() {
  digitalWrite(TRIG_PIN, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIG_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIG_PIN, LOW);
  
  long duration = pulseIn(ECHO_PIN, HIGH);
  long distance = duration * 0.034 / 2;  // Convert time to distance (cm)
  return distance;
}

// Function to check soil moisture level and control relay
void checkSoilMoisture() {
  int moistureValue = analogRead(SOIL_MOISTURE_PIN); // Read soil moisture sensor
  Blynk.virtualWrite(V0, moistureValue);             // Send moisture value to Blynk
  //Serial.println(moistureValue);
  if (moistureValue > 1000) {  // Soil is dry
    digitalWrite(RELAY_PIN, HIGH);  // Turn on water pump
    Serial.println("Watering the plant...");
    //Serial.println(moistureValue);
  } else {
    digitalWrite(RELAY_PIN, LOW);   // Turn off water pump
    Serial.println("Soil moisture is adequate.");
    //Serial.println(moistureValue);
  }
}

// Function to check for obstacles using ultrasonic sensor and send notification if below 50 cm
void checkUltrasonic() {
  long distance = readUltrasonicDistance();
  Blynk.virtualWrite(V1, distance);  // Send distance value to Blynk
  
  if (distance < 50 && !notificationSent) {  // If an obstacle is detected within 50 cm and notification hasn't been sent yet
    digitalWrite(BUZZER_PIN, HIGH);   // Turn on buzzer
    String notificationMessage = "Obstacle detected at " + String(distance) + " cm!";
    Serial.println(notificationMessage);
    //Serial.println(distance);

    // Trigger Blynk event for notification
    
    Blynk.logEvent("obstacle_alert", notificationMessage); 
    notificationSent = true;  // Set flag to avoid sending multiple notifications
    Serial.println("Notification sent.");
  } 
  else if (distance >= 50) {
    //Serial.println(distance);
    digitalWrite(BUZZER_PIN, LOW);   // Turn off buzzer
    notificationSent = false;  // Reset notification flag once the obstacle is gone
  }
}

void setup() {
  // Initialize Serial Monitor
  Serial.begin(115200);
  
  // Set pin modes
  pinMode(TRIG_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);
  pinMode(RELAY_PIN, OUTPUT);
  pinMode(BUZZER_PIN, OUTPUT);

  // Initialize Blynk
  Blynk.begin(auth, ssid, password);
  
  // Set up timers to regularly check sensors
  timer.setInterval(5000L, checkSoilMoisture);  // Check soil moisture every 5 seconds
  timer.setInterval(10000L, checkUltrasonic);    // Check ultrasonic sensor every 2 seconds
}

void loop() {
  Blynk.run();
  timer.run();
}
