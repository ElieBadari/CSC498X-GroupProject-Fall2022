package com.lau.socialmediaapp;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.widget.Toast;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import org.json.JSONObject;
import java.util.Arrays;
import java.util.HashMap;
import java.util.Map;

public class LinkingClass {
    private String base_url = "";
    private RequestQueue queue;
    private StringRequest request;

    public void getPosts(){

    }
    public void getPost(){

    }
    public void addPost(){

    }
    public void addLike(){

    }
    public void deletePost(){

    }
    public void addUser(User user){
        String url = base_url + "add_user.php";


        request = new StringRequest(Request.Method.POST, url, this::onResponse, this::onError) {

            public Map<String, String> getParams() {

                Map<String, String> params = new HashMap<String, String>();
                params.put("username", user.getUsername());
                params.put("password",user.getPassword());
                params.put("email",user.getEmail());
                params.put("bioContent", null);
                return params;
            }

        };
        queue.add(request);

    }

    private void onError(VolleyError volleyError) {
    }

    private void onResponse(String s) {
    }

    public void editProfile(){

    }

}
