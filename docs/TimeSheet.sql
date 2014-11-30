CREATE TABLE IF NOT EXISTS tblCompany(
    pmkCompanyId INT(11) NOT NULL AUTO_INCREMENT,
    fldCompanyName VARCHAR(50) NOT NULL,
    fldFilePath VARCHAR(50) NOT NULL,
    
    PRIMARY KEY(pmkCompanyId)
);

CREATE TABLE IF NOT EXISTS tblUser(
    pmkUserId INT(11) NOT NULL AUTO_INCREMENT,
    fldEmail VARCHAR(50) NOT NULL,
    fldPassword VARCHAR(50) NOT NULL,
    fldFirstName VARCHAR(30) NOT NULL,
    fldLastName VARCHAR(30) NOT NULL,
    fldType VARCHAR(20) NOT NULL,
    fldGender VARCHAR(10) NOT NULL,
    fldAdmissionDate DATE NOT NULL,
    fldPosition VARCHAR(20) NOT NULL,
    fldWorkHours INT(11) NOT NULL,
    
    PRIMARY KEY(pmkUserId)
);

CREATE TABLE IF NOT EXISTS tblProject(
    pmkProjectId INT(11) NOT NULL AUTO_INCREMENT,
    fldName VARCHAR(50) NOT NULL,
    fldDescription VARCHAR(255) NOT NULL,
    fldBudget INT(11) NOT NULL,
    fldExpectedHours INT(11) NOT NULL,
    
    fnkCompanyId INT(11),
    
    PRIMARY KEY(pmkProjectId),
    FOREIGN KEY(fnkCompanyId) REFERENCES tblCompany(pmkCompanyId)
);

CREATE TABLE IF NOT EXISTS tblWorksOn(
    pmkWorksOnId INT(11) NOT NULL AUTO_INCREMENT,
    fldDate DATE NOT NULL,
    fldHours INT(11) NOT NULL,
    fldDescription VARCHAR(255) NOT NULL,
    
    fnkUserId INT(11) NOT NULL,
    fnkProjectId INT(11) NOT NULL,
    
    PRIMARY KEY(pmkWorksOnId),
    FOREIGN KEY(fnkUserId) REFERENCES tblUser(pmkUserId),
    FOREIGN KEY(fnkProjectId) REFERENCES tblProject(pmkProjectId)
);

CREATE TABLE IF NOT EXISTS tblContact(
    pmkContactId INT(11) NOT NULL AUTO_INCREMENT,
    fldEmail VARCHAR(50) NOT NULL,
    fldPhone VARCHAR(20) NOT NULL,
    fldAddress VARCHAR(50) NOT NULL,
    fldState VARCHAR(20) NOT NULL,
    fldZipCode VARCHAR(20) NOT NULL,
    fldCountry VARCHAR(20) NOT NULL,
    fnkUserId INT(11) NOT NULL,
    
    PRIMARY KEY(pmkContactId),
    FOREIGN KEY(fnkUserId) REFERENCES tblUser(pmkUserId)
);