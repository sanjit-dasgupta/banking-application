/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package bankingproject;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.Map;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;
import org.json.simple.JSONArray;

/**
 *
 * @author Sanjit
 */
public class Customer extends User{
    private String bankerName;
    private String bankerPhone;
    private String bankerEmail;
    private ArrayList<Account> accounts;
    public Customer(Map user_details) {
        super(user_details, "Customer");
        accounts = new ArrayList<>();
    }
    void updateAccountsList(JSONArray ja){
        accounts.clear();
        Iterator itr1 = ja.iterator(); 
        while (itr1.hasNext())  
        { 
            accounts.add(new Account((Map) itr1.next()));
        } 
    }
    
    void displayAccounts(JTable jAccountsListTable) {
        DefaultTableModel dtm = (DefaultTableModel) jAccountsListTable.getModel();
        dtm.setRowCount(0);
        for(Account account:accounts){
            account.display(dtm);
        }
    }

    void setBankerDetails(Map map) {
        bankerName = (String)map.get("first_name") + " " + (String)map.get("last_name");
        bankerPhone = (String)map.get("phone_number");
        bankerEmail = (String)map.get("email_address");
    }
    String getBankerName(){
        return bankerName;
    }
    String getBankerPhone(){
        return bankerPhone;
    }
    String getBankerEmail(){
        return bankerEmail;
    }

    String[] getAccountsList() {
        String[] arr = new String[accounts.size()];
        int i = 0;
        for(Account account:accounts){
            arr[i++] = account.getAccountNumber();
        }
        return arr;
    }
}
