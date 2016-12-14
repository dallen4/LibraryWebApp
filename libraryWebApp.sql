  -- Check if exists, create & select database
DROP DATABASE IF EXISTS libraryWebApp;
CREATE DATABASE libraryWebApp;
USE libraryWebApp;

-- Create tables
CREATE TABLE IF NOT EXISTS Book
(ISBN  			CHAR(13) NOT NULL,
Title  			VARCHAR(50)    ,
Author  		VARCHAR(30),
PublishedDate 	DATE,
Publisher 		VARCHAR(50),
KeyWords 		VARCHAR(20),
copyCount               int,
CONSTRAINT Book PRIMARY KEY (ISBN));

CREATE TABLE IF NOT EXISTS Shelf
(ShelfNumber    NUMERIC(11,0)  NOT NULL,
ShelfCategory   VARCHAR(50),
CONSTRAINT Shelf_PK PRIMARY KEY (ShelfNumber));


CREATE TABLE IF NOT EXISTS BookStatus
(BStatusID       NUMERIC(2,0)  NOT NULL,
BookStatus  	 VARCHAR(30),
CONSTRAINT BookStatus_PK PRIMARY KEY (BStatusID ));

CREATE TABLE IF NOT EXISTS BookCopy
(BookID         INT NOT NULL AUTO_INCREMENT,
ISBN         	CHAR(13)       NOT NULL,
ShelfNumber     NUMERIC(10,0)  NOT NULL,
BStatusID       NUMERIC(2,0)  NOT NULL,
CONSTRAINT BookCopy_PK PRIMARY KEY(BookID),
CONSTRAINT BookCopy_FK1 FOREIGN KEY(ShelfNumber) REFERENCES Shelf(ShelfNumber),
CONSTRAINT BookCopy_FK2 FOREIGN KEY(ISBN) REFERENCES Book(ISBN),
CONSTRAINT BookCopy_FK3 FOREIGN KEY(BStatusID) REFERENCES BookStatus(BStatusID));


CREATE TABLE IF NOT EXISTS Supplier
(VendorNumber    NUMERIC(11,0)  NOT NULL,
VendorName       VARCHAR(25), 
VendorAddress    VARCHAR(50),
VendorCity       VARCHAR(50),
VendorState   	 CHAR(2),
VendorZipcode    VARCHAR(20),
CONSTRAINT Supplier_PK PRIMARY KEY (VendorNumber));


CREATE TABLE IF NOT EXISTS Supplies              
(VendorNumber     NUMERIC(11,0)   NOT NULL,
ISBN              CHAR(13)        NOT NULL,
Quantity          INT,
CONSTRAINT Supplies_PK PRIMARY KEY (VendorNumber, ISBN  ),
CONSTRAINT Supplies_FK1 FOREIGN KEY (ISBN) REFERENCES Book(ISBN));

CREATE TABLE IF NOT EXISTS MemberStatus
(MStatusID        NUMERIC(2,0)  NOT NULL,
MemberStatus  	 VARCHAR(30),
CONSTRAINT MemberStatus_PK PRIMARY KEY (MStatusID ));


CREATE TABLE IF NOT EXISTS Member
(MembershipID    INT NOT NULL AUTO_INCREMENT,
UserName       	VARCHAR(25) NOT NULL,
UserPassword    VARCHAR(255) NOT NULL,
MemberAddress   VARCHAR(50),
MemberCity      VARCHAR(50),
MemberState   	CHAR(2),
MemberZipcode   VARCHAR(20),
PhoneNumber     VARCHAR(10),  
MStatusID  		NUMERIC(2,0) NOT NULL,
CONSTRAINT Member_PK PRIMARY KEY (MembershipID ),
 CONSTRAINT Member_UQ UNIQUE (UserName),
CONSTRAINT Member_FK2 FOREIGN KEY (MStatusID) REFERENCES MemberStatus (MStatusID));

CREATE TABLE IF NOT EXISTS Borrowes  
(BookID          INT NOT NULL AUTO_INCREMENT,
MembershipID     INT NOT NULL,
DateBorrowed	 DATE NOT NULL,
DateReturned	 DATE,
DueDate	    	 DATE,
Fee              DECIMAL(6,2),
CONSTRAINT Borrowes_PK PRIMARY KEY (BookID, MembershipID, DateBorrowed),
CONSTRAINT Borrowes_FK1 FOREIGN KEY (BookID) REFERENCES BookCopy(BookID),
CONSTRAINT Borrowes_FK2 FOREIGN KEY (MembershipID) 
REFERENCES Member (MembershipID ));


CREATE TABLE IF NOT EXISTS Adminstrator
(EmployeeID     VARCHAR(10) NOT NULL,
AdminPassword   VARCHAR(255),
CONSTRAINT Adminstrator_PK PRIMARY KEY (EmployeeID));


CREATE TABLE IF NOT EXISTS Manage
(`Operation#`   INT   NOT NULL AUTO_INCREMENT,
EmployeeID      VARCHAR(10)  NOT NULL,
BookID          INT NOT NULL,
OperationDate	TIMESTAMP,
OperationLog  	VARCHAR(100),
CONSTRAINT Manage_PK PRIMARY KEY (`Operation#`),
CONSTRAINT Manage_FK1 FOREIGN KEY(EmployeeID )
REFERENCES Adminstrator (EmployeeID),
CONSTRAINT Manage_FK2 FOREIGN KEY(BookID)
REFERENCES BookCopy(BookID));

-- Create trigger
DELIMITER **
CREATE TRIGGER tri_return
AFTER UPDATE ON borrowes
FOR EACH ROW BEGIN
UPDATE bookcopy SET BStatusID=1 WHERE BookID =old.bookid;
END**
DELIMITER ;

DELIMITER **
CREATE TRIGGER tri_sub
AFTER DELETE ON bookcopy
FOR EACH ROW BEGIN
UPDATE book SET copyCount=copyCount-1 WHERE ISBN =old.ISBN;
END**
DELIMITER ;


-- Populate tables
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`,`copyCount`) VALUES ('9780321884497','Database Design for Mere Mortals: A Hands-On Guide to Relational Database Design (3rd Edition)','Michael J. Hernandez','2013-02-01' ,'Addison-Wesley Professional', 'Database',3);
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`,`copyCount`) VALUES ('9781503935310','Everything We Keep: Novel','Kerry Lonsdale','2016-08-01' ,'Lake Union Publishing', 'Fiction',2);
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`,`copyCount`) VALUES ('9780544104402','How Children Succeed: Grit, Curiosity, and the Hidden Power of Character','Paul Tough','2013-07-01' ,'Mariner Books', 'Education',2);

INSERT INTO shelf(`ShelfNumber`,`ShelfCategory`) VALUES(01001, 'Computer');
INSERT INTO shelf(`ShelfNumber`,`ShelfCategory`) VALUES(01002, 'Literature');
INSERT INTO shelf(`ShelfNumber`,`ShelfCategory`) VALUES(01003, 'Children');
INSERT INTO shelf(`ShelfNumber`,`ShelfCategory`) VALUES(01004, 'Education');

INSERT INTO BookStatus(`BStatusID`,`BookStatus`) VALUES(0, 'Borrowed-inactive');
INSERT INTO BookStatus(`BStatusID`,`BookStatus`) VALUES(1, 'In library');
INSERT INTO Bookstatus(`BStatusID`,`BookStatus`) VALUES(2, 'Lost');
INSERT INTO BookStatus(`BStatusID`,`BookStatus`) VALUES(3, 'Under repairing');

INSERT INTO supplier(`VendorNumber`,`VendorName`,`VendorAddress`,`VendorCity`,`VendorState`,`VendorZipcode`) VALUES(80811,'The Children¡¯s Book Council','54 West 39th Street, 14th Floor','New York', 'NY', '10018');
INSERT INTO supplier(`VendorNumber`,`VendorName`,`VendorAddress`,`VendorCity`,`VendorState`,`VendorZipcode`) VALUES(80812,'ABC-CLIO','P.O. Box 1911', 'Santa Barbara', 'CA', '93116');
INSERT INTO supplier(`VendorNumber`,`VendorName`,`VendorAddress`,`VendorCity`,`VendorState`,`VendorZipcode`) VALUES(80813,'The Library Store','PO Box 0964','Tremont', 'IL', '61568');
INSERT INTO supplier(`VendorNumber`,`VendorName`,`VendorAddress`,`VendorCity`,`VendorState`,`VendorZipcode`) VALUES(80814,'Brodart Order Center','500 Arch Street','Williamsport', 'PA', '17701');


INSERT INTO bookcopy(`ISBN`,`ShelfNumber`,`BStatusID`) VALUES('9780321884497', 1001, 1);
INSERT INTO bookcopy(`ISBN`,`ShelfNumber`,`BStatusID`) VALUES('9780321884497', 1001, 1);
INSERT INTO bookcopy(`ISBN`,`ShelfNumber`,`BStatusID`) VALUES('9780321884497', 1001, 1);
INSERT INTO bookcopy(`ISBN`,`ShelfNumber`,`BStatusID`) VALUES('9781503935310', 1002, 1);
INSERT INTO bookcopy(`ISBN`,`ShelfNumber`,`BStatusID`) VALUES('9781503935310', 1002, 1);
INSERT INTO bookcopy(`ISBN`,`ShelfNumber`,`BStatusID`) VALUES('9780544104402', 1004, 1);
INSERT INTO bookcopy(`ISBN`,`ShelfNumber`,`BStatusID`) VALUES('9780544104402', 1004, 1);

INSERT INTO memberstatus(`MStatusID`,`MemberStatus`) VALUES(0, 'Waiting for approval');
INSERT INTO memberstatus(`MStatusID`,`MemberStatus`) VALUES(1, 'Normal');
INSERT INTO memberstatus(`MStatusID`,`MemberStatus`) VALUES(2, 'Fee Unpaid');

INSERT INTO adminstrator(`EmployeeID`,`AdminPassword`) VALUES('LB2016001','LB2016001');
INSERT INTO adminstrator(`EmployeeID`,`AdminPassword`) VALUES('LB2016002','LB2016002');
INSERT INTO adminstrator(`EmployeeID`,`AdminPassword`) VALUES('LB2016003','LB2016003');

INSERT INTO manage(`EmployeeID`,`BookID`,`OperationDate`,`OperationLog`) VALUES('LB2016001',1, CURRENT_TIMESTAMP, 'Added book and set book status as in library');
