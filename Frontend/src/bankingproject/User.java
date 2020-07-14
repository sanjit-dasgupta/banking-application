/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package bankingproject;

import java.util.Map;

/**
 *
 * @author Sanjit
 */
public class User {
    protected String userName;
    protected String role;
    protected String fname;
    protected String lname;
    protected String dob;
    protected String phoneNumber;
    protected String emailAddress;
    protected String branchID;
    protected String addressID;
    protected Address userAddress;
    protected Branch branchDetails;
    User(Map user_details, String role){
        this.role = role;
        this.userName = (String)user_details.get("username");
        this.fname = (String)user_details.get("first_name");
        this.lname = (String)user_details.get("last_name");
        this.dob = (String)user_details.get("dob");
        this.phoneNumber = (String)user_details.get("phone_number");
        this.emailAddress = (String)user_details.get("email_address");
        this.branchID = (String)user_details.get("branch_id");
        this.addressID = (String)user_details.get("address_id"); 
        this.userAddress = null;
        this.branchDetails = null;
    }
    String getRole(){
       return role; 
    }
    String getUserName(){
        return userName;
    }
    String getName(){
        return fname + " " + lname;
    }

    String getDOB() {
        return dob;
    }

    String getPhone() {
        return phoneNumber;
    }

    String getEmail() {
        return emailAddress;
    }

    void setUserAddress(Map map) {
        userAddress = new Address(map);
    }
    String getUserAddress(){
        return userAddress.toString();
    }
    String getBranchID() {
        return branchID;
    }
    void setBranchDetails(Map map){
        branchDetails = new Branch(map);
    }

    String getBranchName() {
        return branchDetails.getName();
    }

    String getBranchAddress() {
        return branchDetails.getAddress();
    }
}