package com.lau.socialmediaapp;

public class Post {

    private int likes;
    private int owner_id;
    private boolean is_liked;

    public Post(int new_likes, int new_owner_id, boolean new_is_liked){
        likes = new_likes;
        owner_id = new_owner_id;
        is_liked = new_is_liked;
    }
    public void setLikes(int new_likes){
        likes = new_likes;
    }
    public int getLikes(){
        return likes;
    }
    public void setOwner_id(int new_owner_id){
        owner_id = new_owner_id;
    }
    public int getOwner_id(){
        return owner_id;
    }
    public void setIsliked(boolean new_is_liked){
        is_liked = new_is_liked;
    }
    public boolean getIsLiked(){
        return is_liked;
    }
    public void addLike(){
        likes++;
    }
    public void removeLike(){
        likes--;
    }



}
