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
public class Address {
    private final String id;
    private final String line1;
    private final String line2;
    private final String city;
    private final String state;
    private final String pinCode;
    public Address(Map map){
        id = (String)map.get("ID");
        line1 = (String)map.get("Line1");
        line2 = (String)map.get("Line2");
        city = (String)map.get("City");
        state = (String)map.get("State");
        pinCode = (String)map.get("PinCode");
    }
    @Override
    public String toString(){
        return line1 + "\r\n" + line2 + "\r\n" + city + ", " + state + " - " + pinCode;
    }
}
