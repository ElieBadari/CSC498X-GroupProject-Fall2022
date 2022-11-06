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

public class LinkingApis {
    private String base_url = "";
    private RequestQueue queue;
    private StringRequest request;

    public void getPosts(int id){
        String url = base_url + "get_articles.php?id=" + id ;
        request = new StringRequest(Request.Method.GET, url, this::onResponse, this::onError);
        queue.add(request);
    }
    public void getPost(){

    }
    public void addPost(){

    }
    public void addLike(){

    }
    public void deletePost(){

    }
    public void addUser(){

    }
    public void editProfile(){

    }

}
