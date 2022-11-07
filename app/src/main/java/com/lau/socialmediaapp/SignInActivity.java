package com.lau.socialmediaapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class SignInActivity extends AppCompatActivity {
    EditText username;
    EditText password;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_in);
    }

    public void logIn(View view) {
        username = findViewById(R.id.username);
        password = findViewById(R.id.password);

        Intent i = new Intent(SignInActivity.this, FeedActivity.class);
        startActivity(i);
    }

    public void signIn(View view) {
        Intent i = new Intent(SignInActivity.this, SignUpActivity.class);
        startActivity(i);
    }
}