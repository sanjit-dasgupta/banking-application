/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package bankingproject;

import java.util.Map;
import javax.swing.table.DefaultTableModel;

/**
 *
 * @author Sanjit
 */
public class Account {
    private final String accountNumber;
    private final String accountType;
    private final String balance;
    private final String approved;

    Account(Map map) {
        accountNumber = (String)map.get("account_number");
        accountType = (String)map.get("account_type");
        balance = (String)map.get("balance");
        approved = (String)map.get("approved");
    }

    void display(DefaultTableModel dtm) {
        String status = approved.equals("Y")?"Approved":"Under Review";
        dtm.addRow(new Object[]{accountNumber, accountType, balance, status});
    }
    String getAccountNumber(){
        return accountNumber;
    }
}
