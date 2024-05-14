<?php 

session_start(); 
    $sname= "localhost";
    $uname= "root";
    $password = "";


    /*connecting to server*/
    $conn = mysqli_connect($sname, $uname, $password);
    if (!$conn) {
        echo "Connection failed!";
    }
    
    //create database
    $sql="CREATE DATABASE Track_My_Psyche";
    if (mysqli_query($conn, $sql))
    {
        echo "ok";
    }


    $sql2="USE Track_My_Psyche";
    if (mysqli_query($conn, $sql2))
    {
        echo "ok2";
    }
    
    $sql3="CREATE TABLE User_Profile (
    userID INT(5) NOT NULL AUTO_INCREMENT,
    fname varchar(20) NOT NULL,
    username varchar(30) NOT NULL,
    email varchar(30) NOT NULL,
    password varchar(20) NOT NULL,
    PRIMARY KEY (userID)
    )";
    if (mysqli_query($conn, $sql3))
    {
        echo "ok3";
    }
    
    $sql4="CREATE TABLE Conditions (
    ConditionID INT(10) NOT NULL AUTO_INCREMENT,
    ConditionName varchar(30) NOT NULL,
    PRIMARY KEY (ConditionID)
    )";
    if (mysqli_query($conn, $sql4))
    {
        echo "ok4";
    }
    
    $sql5="CREATE TABLE User_Conditions (
    UCID int(10) NOT NULL AUTO_INCREMENT,
    userID int(10) NOT NULL,
    ConditionID int(10) NOT NULL,
    PRIMARY KEY (UCID),
    CONSTRAINT FK_USER FOREIGN KEY (userID)
    REFERENCES User_Profile(userID),
    CONSTRAINT FK_COND FOREIGN KEY (ConditionID)
    REFERENCES Conditions(ConditionID)
    )";
    if (mysqli_query($conn, $sql5))
    {
        echo "ok5";
    }
    
    $sql6="CREATE TABLE User_Condition_Rating (
    UCRID int(10) NOT NULL AUTO_INCREMENT,
    userID int(10) NOT NULL,
    condID int(10) NOT NULL,
    rating int(10) NOT NULL,
    theDate date NOT NULL,
    PRIMARY KEY (UCRID),
    CONSTRAINT FK_USERID FOREIGN KEY (userID)
    REFERENCES User_Profile(userID),
    CONSTRAINT FK_CONDITION FOREIGN KEY (condID)
    REFERENCES Conditions(ConditionID)
    )";
    if (mysqli_query($conn, $sql6))
    {
        echo "ok7";
    }

    $sql7="INSERT INTO Conditions (ConditionName) VALUES ('Happy'), ('Angry'), ('Sad'), ('Anxious'), ('Sleep')";
    if(mysqli_query($conn, $sql7))
    {
        echo "yep5";
    }
    header("location:userguide.html");

