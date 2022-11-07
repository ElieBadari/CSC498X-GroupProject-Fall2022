package com.lau.socialmediaapp;

public class User {

    private String username;
    private String email;
    private String password;
    private String bio_content;

    public  User (String new_username, String new_email, String new_password, String new_bio_content){
        username = new_username;
        email = new_email;
        password = new_password;
        bio_content = new_bio_content;
    }
    public User(String new_username, String new_password){
        username = new_username;
        password = new_password;
        email = " ";
        bio_content = " ";
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String new_username) {
        username = new_username;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String new_email) {
        email = new_email;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String new_password) {
        password = new_password;
    }

    public String getBio_content() {
        return bio_content;
    }

    public void setBio_content(String new_bio_content) {
        bio_content = new_bio_content;
    }
}
