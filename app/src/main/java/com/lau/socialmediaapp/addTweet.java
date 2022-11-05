package com.lau.socialmediaapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class addTweet extends AppCompatActivity {
EditText tweet;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_tweet);
        tweet=findViewById(R.id.tweet_content);
    }

    public void back(View v){
        Intent intent= new Intent(getApplicationContext(),NewsDisplay.class);
        startActivity(intent);
    }
    public void addtweet(View v){
        
    }
}