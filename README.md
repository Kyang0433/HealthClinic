# HealthClinic
**Contributors:**
Jarrod Young: https://github.com/jarrody97
Kevin Yang: https://github.com/kyang0433

**Overview**
This is a fun little project that emulates how we think a health clinic or hospital might design a relational database. The database stores information about patients and clinicians, as well as appointments, diagnoses, and conditions. The target users for the database are the clinic staff. Tools are available to add or remove patients from the database, schedule or cancel appointments, add prescribed medications or diagnosed conditions. Users can query the database to show a summary of a given patient’s data, including contact information, upcoming appointments, current prescriptions, and currently diagnosed conditions. Additionally, users can show all appointments within a given date range for a given patient, provider, or patient-provider combination.

**Technologies Used**
* MySQL
* Javascript
* PHP
* HTML/CSS

**Video**

![](health-clinic-dbms-demo.gif =250x)

**Entity Relation Diagram**

![](health-clinic-ER-diagram.svg)


**Features**
* Uses 12 tables/relations to store data relevant to a health clinic’s day-to-day operations. This data ranges from patients that the clinic serves and doctors that the clinic employs to scheduled appointments and documented diseases and medicines.
* Can view, add, update, and delete data as demonstrated above
* Boyce-Codd Normal Form, as depicted in entity relationship diagram
* Gives warning when attempting to prescribe drug to patient that is already prescribed another drug that interacts with former drug 
* Can list appointments given patient info, doctor info, and time range
