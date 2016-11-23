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
(BookID         NUMERIC(11,0)  NOT NULL,
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
(BookID          NUMERIC(11,0) NOT NULL,
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
(`Operation#`   INT  		   NOT NULL AUTO_INCREMENT,
EmployeeID      VARCHAR(10)  NOT NULL,
BookID          NUMERIC(11,0)  NOT NULL,
OperationDate	TIMESTAMP,
OperationLog  	VARCHAR(100),
CONSTRAINT Manage_PK PRIMARY KEY (`Operation#`),
CONSTRAINT Manage_FK1 FOREIGN KEY(EmployeeID )
REFERENCES Adminstrator (EmployeeID),
CONSTRAINT Manage_FK2 FOREIGN KEY(BookID)
REFERENCES BookCopy(BookID));


-- Populate tables
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`) VALUES ('9780321884497','Database Design for Mere Mortals: A Hands-On Guide to Relational Database Design (3rd Edition)','Michael J. Hernandez','2013-02-01' ,'Addison-Wesley Professional', 'Datebase');
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`) VALUES ('9781934356920','Seven Databases in Seven Weeks\: A Guide to Modern Databases and the NoSQL Movement','Eric Redmond; Jim Wilson','2012-05-01' ,'Pragmatic Bookshelf', 'Database');
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`) VALUES ('9780062413901','How to Use Graphic Design to Sell Things, Explain Things, Make Things Look Better, Make People Laugh, Make People Cry, and (Every Once in a While) Change the World','Michael Bierut','2015-11-01' ,'Harper Design', 'Design');
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`) VALUES ('9780465050659','The Design of Everyday Things: Revised and Expanded Edition','Don Norman','2013-11-01' ,'Basic Books', 'Design');
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`) VALUES ('9781482317800','Tongue Twisters for Kids','Riley Weber','2013-03-01' ,'CreateSpace Independent Publishing Platform', 'Kids');
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`) VALUES ('9781580625579','The Everything Kids\' Science Experiments Book Boil Ice, Float Water, Measure Gravity-Challenge the World Around You!','Tom Robinson','2001-10-01' ,'Adams Media', 'Kids');
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`) VALUES ('9781503935310','Everything We Keep: Novel','Kerry Lonsdale','2016-08-01' ,'Lake Union Publishing', 'Fiction');
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`) VALUES ('9780451419927','Secrets of a Charmed Life','Susan Meissner','2015-02-01' ,'NAL', 'Fiction');
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`) VALUES ('9780143108061','Creative Schools: The Grassroots Revolution That\'s Transforming Education','Ken Robins Ph.D.; Lou Aronica','2016-04-01' ,'Penguin Books', 'Education');
INSERT INTO Book(`ISBN`,`Title`,`Author`,`PublishedDate`,`Publisher`, `KeyWords`) VALUES ('9780544104402','How Children Succeed: Grit, Curiosity, and the Hidden Power of Character','Paul Tough','2013-07-01' ,'Mariner Books', 'Education');

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

INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80811, '9781580625579', 15);
INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80811, '9781482317800', 25);
INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80811, '9780544104402', 10);
INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80812, '9780321884497', 10);
INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80812, '9781934356920', 15);
INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80813, '9780321884497', 8);
INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80813, '9780544104402', 6);
INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80813, '9780465050659', 18);
INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80814, '9780451419927', 8);
INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80814, '9781503935310', 10);
INSERT INTO supplies(`VendorNumber`,`ISBN`,`Quantity`) VALUES(80814, '9780143108061', 5);

INSERT INTO bookcopy(`BookID`,`ISBN`,`ShelfNumber`,`BStatusID`) VALUES(170001, '9780321884497', 1001, 1);
INSERT INTO bookcopy(`BookID`,`ISBN`,`ShelfNumber`,`BStatusID`) VALUES(170002, '9780321884497', 1001, 0);
INSERT INTO bookcopy(`BookID`,`ISBN`,`ShelfNumber`,`BStatusID`) VALUES(170003, '9780321884497', 1001, 0);
INSERT INTO bookcopy(`BookID`,`ISBN`,`ShelfNumber`,`BStatusID`) VALUES(180001, '9781503935310', 1002, 1);
INSERT INTO bookcopy(`BookID`,`ISBN`,`ShelfNumber`,`BStatusID`) VALUES(180002, '9781503935310', 1002, 1);
INSERT INTO bookcopy(`BookID`,`ISBN`,`ShelfNumber`,`BStatusID`) VALUES(190001, '9780544104402', 1004, 1);
INSERT INTO bookcopy(`BookID`,`ISBN`,`ShelfNumber`,`BStatusID`) VALUES(190002, '9780544104402', 1004, 2);

INSERT INTO memberstatus(`MStatusID`,`MemberStatus`) VALUES(0, 'Waiting for approval');
INSERT INTO memberstatus(`MStatusID`,`MemberStatus`) VALUES(1, 'Normal');
INSERT INTO memberstatus(`MStatusID`,`MemberStatus`) VALUES(3, 'Fee Unpaid');

INSERT INTO adminstrator(`EmployeeID`,`AdminPassword`) VALUES('LB2016001','LB2016001');
INSERT INTO adminstrator(`EmployeeID`,`AdminPassword`) VALUES('LB2016002','LB2016002');
INSERT INTO adminstrator(`EmployeeID`,`AdminPassword`) VALUES('LB2016003','LB2016003');

INSERT INTO manage(`EmployeeID`,`BookID`,`OperationDate`,`OperationLog`) VALUES('LB2016001',170001, CURRENT_TIMESTAMP, 'Added book and set book status as in library');
INSERT INTO manage(`EmployeeID`,`BookID`,`OperationDate`,`OperationLog`) VALUES('LB2016001',190001, CURRENT_TIMESTAMP, 'Marked book status as Lost'); 