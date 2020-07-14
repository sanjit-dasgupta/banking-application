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
public class Branch {
    private final String id;
    private final String name;
    private final Address branchAddress;
    public Branch(Map map){
        id = (String)map.get("id");
        name = (String)map.get("Name");
        branchAddress = new Address(map);
    }

    String getName() {
        return name;
    }

    String getAddress() {
        return branchAddress.toString();
    }

    String getID() {
        return id;
    }
}
