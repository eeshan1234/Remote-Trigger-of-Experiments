
#include<Servo.h> // servo motor object for its control
Servo myservo;
char ibyte;
int z;
#define enA 6
#define in1 5
#define in2 4
String temp="";
String temp1="";

const int pingPin = 2; // Trigger Pin of Ultrasonic Sensor
const int echoPin = 3; // Echo Pin of Ultrasonic Sensor
int ang = 0;    // a variable to store the servo angle
int flag=-1;
void(* resetFunc)(void)=0;
void setup()
{
  Serial.begin(9600);
  
  pinMode(enA, OUTPUT);
  pinMode(in1, OUTPUT);
  pinMode(in2, OUTPUT);
  pinMode(pingPin, OUTPUT);
 pinMode(echoPin, INPUT);
 myservo.attach(8);  
}
void loop()
{
  while(Serial.available())
  {
    ibyte=Serial.read();
    if(ibyte=='h')
    {  
      temp=temp+ibyte;
    }
    if(ibyte!='h' && ibyte!='*')
    {
      if(temp1.toInt()>=10)
        temp1="";
      temp1=temp1+ibyte;
    } 

  }
  
  z=temp1.toInt();
  
   if(temp=="h"){
if(flag!=2){
   long duration;
   float  cm, length1;
  
   
   //enter Z between 55 and 82 cm
   
 
   
   digitalWrite(pingPin, LOW);
   delayMicroseconds(2);
   digitalWrite(pingPin, HIGH);
   delayMicroseconds(2);
   digitalWrite(pingPin, LOW);
  
   duration = pulseIn(echoPin, HIGH,80000);
  
   cm = microsecondsToCentimeters(duration);
   
   length1=100-cm;
   z=100-z; //45
   if(millis()%100){
   //Serial.print(length1);
   //Serial.print("cm");
   //Serial.println();
   }
   //delay(100);
   
   //motor

  if(cm>z+1)
  {
    Serial.println("Below");
      analogWrite(enA, 80);
      digitalWrite(in1, LOW);
      digitalWrite(in2, HIGH);
 

  }


  else  if(cm<z-1)
  {
    
    Serial.println("Above");
       analogWrite(enA, 120);
      digitalWrite(in1, HIGH);
      digitalWrite(in2, LOW);


  }
else if(cm>z-1||cm<z+1 || cm<18 ||cm>48)
{
  
    Serial.println("Stopped");
 
    flag=0;
        digitalWrite(in1, HIGH);
      digitalWrite(in2, HIGH);

}

  //delay(100);
}
   
if(flag==0 ){
if(ang!=160)
{ 
  for (; ang <160; ang += 5) // goes from 0 degrees to 180 degrees with a step og 5 degree
  { 
    myservo.write(ang);              // rotates the servo to rotate at specific angle
    delay(50);     // adding delay of 50 msec
   
   }
  

}      
 else  if(ang==160)
   {
      myservo.write(0); 
   }
flag=2;
}
   }
   if(flag==2)
   {
     resetFunc();
   }
}  
float microsecondsToCentimeters(long microseconds) {
   return float(microseconds) / 29 / 2;
}
