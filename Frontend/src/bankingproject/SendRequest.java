/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package bankingproject;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.net.URL;
import static javafx.css.StyleOrigin.USER_AGENT;
import javax.swing.SwingWorker;

/**
 *
 * @author Sanjit
 */
public class SendRequest extends SwingWorker<String, Void>{
    static String baseUrl = "http://sunny.florenceangel.com/banking/";  
    String URL, param;
    SendRequest(String URL, String param){
        this.URL = URL;
        this.param = param;
    }
    static String request(String URL, String param) throws MalformedURLException, ProtocolException, IOException{
       String url = SendRequest.baseUrl + URL;
	URL obj = new URL(url);
	HttpURLConnection con = (HttpURLConnection) obj.openConnection();
	con.setRequestMethod("POST");
	con.setRequestProperty("User-Agent", USER_AGENT.toString());
	con.setRequestProperty("Accept-Language", "en-US,en;q=0.5");
        //con.setRequestProperty("Cookie", "token=" + User.token);
        //System.out.println("Cookie = " + User.token);
	String urlParameters = param;	
	con.setDoOutput(true);
        try (DataOutputStream wr = new DataOutputStream(con.getOutputStream())) {
            wr.writeBytes(urlParameters);
            wr.flush();
        }
	//int responseCode = con.getResponseCode();
	/*System.out.println("\nSending 'POST' request to URL : " + url);
	System.out.println("Post parameters : " + urlParameters);
	System.out.println("Response Code : " + responseCode);*/
        StringBuffer response;
        try (BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()))) {
            String inputLine;
            response = new StringBuffer();
            while ((inputLine = in.readLine()) != null) {
                response.append(inputLine);
            }	
        }
	//System.out.println(response.toString()); 
        return response.toString();
    }

    @Override
    protected String doInBackground() throws Exception {
        return request(URL, param);
    }
}
