package com.lau.socialmediaapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class MainActivity extends AppCompatActivity {
    EditText username;
    EditText password;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }
    public void submit(View v){
        username =findViewById(R.id.tweet_content);
        username =findViewById(R.id.password);


        Intent intent = new Intent(getApplicationContext(), NewsDisplay.class);
        startActivity(intent);


    }
}