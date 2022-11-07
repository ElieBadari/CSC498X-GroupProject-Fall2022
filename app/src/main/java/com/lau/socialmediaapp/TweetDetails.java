package com.lau.socialmediaapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

public class TweetDetails extends AppCompatActivity {
    TextView tweet;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tweet_details);
        tweet=findViewById(R.id.tweet);
        tweet.setText("bdjshgfjkhsadjkfgjksadfgjksdgfjkgdsf");
    }
    public void likeTweet(View v){

    }
    public void back(View v){
        Intent intent= new Intent(getApplicationContext(), FeedActivity.class);
        startActivity(intent);
    }
}