package com.lau.socialmediaapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
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

public class SignUpActivity extends AppCompatActivity {
    EditText username;
    EditText password;
    EditText email;
    private String base_url = "";
    private RequestQueue queue;
    private StringRequest request;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);
        queue = Volley.newRequestQueue(SignUpActivity.this);
    }
    public void signUp(View v){
        username = findViewById(R.id.username);
        password = findViewById(R.id.password);
        email = findViewById(R.id.email);

        User user = new User(username.getText().toString(),password.getText().toString(),email.getText().toString(),null);
        addUser(user);
        Intent intent = new Intent(getApplicationContext(), SplashActivity.class);
        startActivity(intent);


    }
    public void signIn(View v){
        Intent i = new Intent(getApplicationContext(), SignInActivity.class);
        startActivity(i);
    }
    public void addUser(User user){
        String url = base_url + "add_user.php";


        request = new StringRequest(Request.Method.POST, url, this::onResponse, this::onError) {

            public Map<String, String> getParams() {

                Map<String, String> params = new HashMap<String, String>();
                params.put("username", user.getUsername());
                params.put("password",user.getPassword());
                params.put("email",user.getEmail());
                params.put("bioContent", user.getBio_content());
                return params;
            }

        };
        queue.add(request);

    }

    public void onError(VolleyError error){
        Toast.makeText(SignUpActivity.this, "Error", Toast.LENGTH_LONG).show();
    }

    public void onResponse(String response){
        Toast.makeText(SignUpActivity.this, "Data Retrieved from the Server", Toast.LENGTH_SHORT).show();
        try{
            JSONObject json = new JSONObject((response));
            int user_id = json.getInt("userId");

            Log.i("Response", json.toString());
        }catch(Exception e){
            Log.i("Error", Arrays.toString(e.getStackTrace()));
        }
    }
}