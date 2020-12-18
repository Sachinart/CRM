--
-- Table structure for table `members`
--
-- Assumptions for role
-- 1 for admin
-- 2 for employee



CREATE TABLE IF NOT EXISTS members (
	id				INT(11)			NOT NULL AUTO_INCREMENT,
	firstName		VARCHAR(50)		NOT NULL,
	lastName		VARCHAR(50)		NOT NULL,
	email			VARCHAR(50)		NOT NULL,
	username		VARCHAR(15)		NOT NULL,
	password		CHAR(128)		NOT NULL,
	role			INT(1)			NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data into table `members`
--

INSERT INTO `members` (`id`, `firstName`, `lastName`, `email`, `username`, `password`, `role`)
VALUES (NULL, 'admin', 'admin', 'admin@admin.com', 'admin', '$2y$10$Vf14qRLy18AKDr66yOuAq.FkBgAuIgtd0zQAK0CdaqA2txw2CmVAu', '1');

--
-- Table structure for table `states`
--

CREATE TABLE states (
	id 		int(11) 		NOT NULL auto_increment,
	code 	varchar(2) 		NOT NULL default '',
	name 	varchar(100) 	NOT NULL default '',
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-- 
-- Dumping data for table `states`
-- 
	INSERT INTO `states` VALUES (null, 'AN', 'Andaman and Nicobar Islands');
	INSERT INTO `states` VALUES (null, 'AP', 'Andhra Pradesh');
	INSERT INTO `states` VALUES (null, 'AR', 'Arunachal Pradesh');
	INSERT INTO `states` VALUES (null, 'AS', 'Assam');
	INSERT INTO `states` VALUES (null, 'BR', 'Bihar');
	INSERT INTO `states` VALUES (null, 'CH', 'Chandigarh');
	INSERT INTO `states` VALUES (null, 'CT', 'Chhattisgarh');
	INSERT INTO `states` VALUES (null, 'DN', 'Dadra and Nagar Haveli');
	INSERT INTO `states` VALUES (null, 'DD', 'Daman and Diu');
	INSERT INTO `states` VALUES (null, 'DL', 'Delhi');
	INSERT INTO `states` VALUES (null, 'GA', 'Goa');
	INSERT INTO `states` VALUES (null, 'GJ', 'Gujarat');
	INSERT INTO `states` VALUES (null, 'HR', 'Haryana');
	INSERT INTO `states` VALUES (null, 'HP', 'Himachal Pradesh');
	INSERT INTO `states` VALUES (null, 'JK', 'Jammu and Kashmir');
	INSERT INTO `states` VALUES (null, 'JH', 'Jharkhand');
	INSERT INTO `states` VALUES (null, 'KA', 'Karnataka');
	INSERT INTO `states` VALUES (null, 'KL', 'Kerala');
	INSERT INTO `states` VALUES (null, 'LD', 'Lakshadweep');
	INSERT INTO `states` VALUES (null, 'MP', 'Madhya Pradesh');
	INSERT INTO `states` VALUES (null, 'MH', 'Maharashtra');
	INSERT INTO `states` VALUES (null, 'MN', 'Manipur');
	INSERT INTO `states` VALUES (null, 'ML', 'Meghalaya');
	INSERT INTO `states` VALUES (null, 'MZ', 'Mizoram');
	INSERT INTO `states` VALUES (null, 'OR', 'Odisha, Orissa');
	INSERT INTO `states` VALUES (null, 'PY', 'Puducherry');
	INSERT INTO `states` VALUES (null, 'PB', 'Punjab');
	INSERT INTO `states` VALUES (null, 'RJ', 'Rajasthan');
	INSERT INTO `states` VALUES (null, 'SK', 'Sikkim');
	INSERT INTO `states` VALUES (null, 'TN', 'Tamil Nadu');
	INSERT INTO `states` VALUES (null, 'TG', 'Telangana');
	INSERT INTO `states` VALUES (null, 'TR', 'Tripura');
	INSERT INTO `states` VALUES (null, 'UP', 'Uttar Pradesh');
	INSERT INTO `states` VALUES (null, 'UT', 'Uttarakhand,Uttaranchal');
	INSERT INTO `states` VALUES (null, 'WB', 'West Bengal');

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS customers (
	id				INT(11)			NOT NULL AUTO_INCREMENT,
	firstName		VARCHAR(50)		NOT NULL,
	lastName		VARCHAR(50)		NOT NULL,
	email			VARCHAR(50)		NOT NULL,
	mobNo			BIGINT(15)		NOT NULL,
	stateId			INT(11)			NOT NULL,
	gst				VARCHAR(15)		NOT NULL,
	pan				VARCHAR(10)		NOT NULL,
	deliveryAddr	VARCHAR(500)	NOT NULL,
	creationDate	VARCHAR(30)		NOT NULL,
	updationDate	VARCHAR(30)		NOT NULL,
	isDeleted		INT(1)			NOT NULL DEFAULT 0,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `quotations`
--

CREATE TABLE IF NOT EXISTS quotations (
	id				INT(11)			NOT NULL AUTO_INCREMENT,
	item			VARCHAR(100)	NOT NULL,
	itemDesc		VARCHAR(500)	NOT NULL,
	quantity		INT(11)			NOT NULL,
	customerId		INT(11)			NOT NULL,
	rate			VARCHAR(10)		NOT NULL,
	tnc				VARCHAR(500)	NOT NULL,
	deliveryTime	INT(11)			NOT NULL,
	cgst			VARCHAR(10)		NOT NULL,
	sgst			VARCHAR(10)		NOT NULL,
	igst			VARCHAR(10)		NOT NULL,
	orderValue		INT(11)			NOT NULL,
	creationDate	VARCHAR(30)		NOT NULL,
	updationDate	VARCHAR(30)		NOT NULL,
	status			INT(11)			NOT NULL,
	isDeleted		INT(1)			NOT NULL DEFAULT 0,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS orders (
	id				INT(11)		NOT NULL AUTO_INCREMENT,
	quotId			INT(11)		NOT NULL,
	status			INT(11)		NOT NULL,
	creationDate	VARCHAR(30)	NOT NULL,
	updationDate	VARCHAR(30)	NOT NULL,
	isDeleted		INT(1)		NOT NULL DEFAULT 0,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `quotCmts`
--

CREATE TABLE IF NOT EXISTS quotCmts (
	id				INT(11)			NOT NULL AUTO_INCREMENT,
	quotId			INT(11)			NOT NULL,
	comments		VARCHAR(1000)	NOT NULL,
	creationDate	VARCHAR(30)		NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Table structure for table `priviledges`
--

/* 
priviledges
id
userId
module
add
edit
delete */

CREATE TABLE IF NOT EXISTS privilege (
	id				INT(11)			NOT NULL AUTO_INCREMENT,
	userId			INT(11)			NOT NULL,	
	custAdd			TINYINT(1)		NOT NULL,	
	custEdit		TINYINT(1)		NOT NULL,	
	custDel			TINYINT(1)		NOT NULL,	
	quotAdd			TINYINT(1)		NOT NULL,	
	quotEdit		TINYINT(1)		NOT NULL,	
	quotDel			TINYINT(1)		NOT NULL,	
	quotCmtAdd		TINYINT(1)		NOT NULL,	
	quotCmtEdit		TINYINT(1)		NOT NULL,	
	quotCmtDel		TINYINT(1)		NOT NULL,	
	orderAdd		TINYINT(1)		NOT NULL,	
	orderEdit		TINYINT(1)		NOT NULL,	
	orderDel		TINYINT(1)		NOT NULL,	
	userAdd			TINYINT(1)		NOT NULL,	
	userEdit		TINYINT(1)		NOT NULL,	
	userDel			TINYINT(1)		NOT NULL,	
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping privileges of admin user 
--

INSERT INTO `privilege` (`id`, `userId`, `custAdd`, `custEdit`, `custDel`, `quotAdd`, `quotEdit`, `quotDel`, `quotCmtAdd`, `quotCmtEdit`, `quotCmtDel`, `orderAdd`, `orderEdit`, `orderDel`, `userAdd`, `userEdit`, `userDel`) VALUES (NULL, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');

--
-- Table structure for table `alerts`
--

CREATE TABLE IF NOT EXISTS alerts (
	id				INT(11)			NOT NULL AUTO_INCREMENT,
	moduleName		VARCHAR(50)		NOT NULL,
	message			VARCHAR(1000)	NOT NULL,
	creationDate	VARCHAR(30)		NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `alertEmails`
--

CREATE TABLE IF NOT EXISTS alertEmails (
	id				INT(11)			NOT NULL AUTO_INCREMENT,
	moduleName		VARCHAR(50)		NOT NULL,
	emails			VARCHAR(500)	NOT NULL,
	creationDate	VARCHAR(30)		NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;