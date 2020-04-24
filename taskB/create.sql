CREATE TABLE PROVIDER(
Fname VARCHAR(15) NOT NULL,
Mname VARCHAR(15),
Lname VARCHAR(15) NOT NULL,
Title VARCHAR(5) NOT NULL,
Ssn CHAR(9) PRIMARY KEY,
Phone CHAR(10),
Email VARCHAR(40),
Salary INT NOT NULL);

CREATE TABLE PATIENT(
Fname VARCHAR(15) NOT NULL,
Mname VARCHAR(15),
Lname VARCHAR(15) NOT NULL,
Ssn CHAR(9) PRIMARY KEY,
Phone CHAR(10),
Address VARCHAR(60),
Email VARCHAR(40),
DOB DATE NOT NULL,
Insurance_provider VARCHAR(20),
Provider_Ssn CHAR(9),
UNIQUE (Fname, Lname, DOB),
FOREIGN KEY (Provider_Ssn) REFERENCES PROVIDER(Ssn)
ON UPDATE CASCADE
ON DELETE SET NULL);

CREATE TABLE MEDICATION(
Brand_name VARCHAR(20) PRIMARY KEY,
Chemical_name VARCHAR(30) UNIQUE,
Classification VARCHAR(20));

CREATE TABLE HEALTH_CONDITION(
Condition_name VARCHAR(25) PRIMARY KEY,
Condition_type VARCHAR(15));

CREATE TABLE APPOINTMENT(
Reason_for_visit VARCHAR(60),
Appt_time TIME,
Appt_date DATE,
Copayment INT,
Provider_Ssn CHAR(9),
Patient_Ssn CHAR(9),
PRIMARY KEY (Appt_time, Appt_date, Provider_Ssn),
UNIQUE (Appt_time, Appt_date, Patient_Ssn),
FOREIGN KEY (Provider_Ssn) REFERENCES PROVIDER(Ssn)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
FOREIGN KEY (Patient_Ssn) REFERENCES PATIENT(Ssn)
    ON UPDATE CASCADE
    ON DELETE CASCADE);

CREATE TABLE PRESCRIPTION(
Brand_name VARCHAR(20) NOT NULL,
Patient_Ssn CHAR(9) REFERENCES PATIENT(Ssn),
Dosage VARCHAR(10) NOT NULL,
DATE_PRESCRIBED DATE,
PRIMARY KEY (Brand_name, Patient_Ssn),
FOREIGN KEY (Brand_name) REFERENCES MEDICATION(Brand_name)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
FOREIGN KEY (Patient_Ssn) REFERENCES PATIENT(Ssn)
    ON UPDATE CASCADE
    ON DELETE CASCADE);

CREATE TABLE DIAGNOSIS(
Condition_name VARCHAR(25),
Patient_Ssn CHAR(9) REFERENCES PATIENT(Ssn),
Date_diagnosed DATE,
PRIMARY KEY (Condition_name, Patient_Ssn),
FOREIGN KEY (Condition_name) REFERENCES HEALTH_CONDITION(Condition_name)
    ON UPDATE CASCADE
    ON DELETE CASCADE);

CREATE TABLE DO_NOT_MIX(
Brand_name1 VARCHAR(20) NOT NULL,
Brand_name2 VARCHAR(20) NOT NULL,
FOREIGN KEY (Brand_name1) REFERENCES MEDICATION(Brand_name)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
FOREIGN KEY (Brand_name2) REFERENCES MEDICATION(Brand_name)
    ON UPDATE CASCADE
    ON DELETE CASCADE);

CREATE TABLE TREATMENT_FOR(
Brand_name VARCHAR(20) NOT NULL REFERENCES MEDICATION(Brand_name),
Condition_name VARCHAR(25) NOT NULL,
FOREIGN KEY (Condition_name) REFERENCES HEALTH_CONDITION(Condition_name)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
FOREIGN KEY (Brand_name) REFERENCES MEDICATION(Brand_name)
    ON UPDATE CASCADE
    ON DELETE CASCADE);

CREATE TABLE SYMPTOMS (
Condition_name VARCHAR(25) NOT NULL,
Symptom VARCHAR(30) NOT NULL,
FOREIGN KEY (Condition_name) REFERENCES HEALTH_CONDITION(Condition_name)
    ON UPDATE CASCADE
    ON DELETE CASCADE);

CREATE TABLE SIDE_EFFECTS(
Brand_name VARCHAR(20) NOT NULL,
Side_effect VARCHAR(20) NOT NULL,
FOREIGN KEY (Brand_name) REFERENCES MEDICATION(Brand_name)
    ON UPDATE CASCADE
    ON DELETE CASCADE);



							







