package com.lau.socialmediaapp;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;

public class NewsDisplay extends AppCompatActivity {

    ListView my_list;
    ArrayList<String> the_list;
    ArrayAdapter<String>adapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        my_list = findViewById(R.id.my_list);
        the_list = new ArrayList<String>();
    /*    try{

            SQLiteDatabase sql = this.openOrCreateDatabase("newsdb", MODE_PRIVATE, null);
            sql.execSQL("CREATE Table IF NOT EXISTS news (news_name VARCHAR, author VARCHAR, published_at TEXT, location VARCHAR, description TEXT)");
            Cursor c = sql.rawQuery("Select * from news", null);
            int n_nameIndex = c.getColumnIndex("news_name");
            c.moveToFirst();
            if(c.getCount()==0){
                Toast.makeText(this, "No News Yet", Toast.LENGTH_SHORT).show();
            }else{
                while(c!= null){
                    String news_name_n = c.getString(n_nameIndex) + " ";
                    the_list.add(news_name_n);
                    c.moveToNext();
                }
            }
        }catch(Exception e){
            e.printStackTrace();
        }
*/
        adapter = new ArrayAdapter<String>(getApplicationContext(), android.R.layout.simple_list_item_1, the_list);
        my_list.setAdapter(adapter);
        my_list.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                Intent intent = new Intent(getApplicationContext(), TweetDetails.class);
                intent.putExtra("news_name", the_list.get(i));
                startActivity(intent);
            }
        });
    }

    public void addNews(View v){
        Intent intent= new Intent(getApplicationContext(),addTweet.class);
        startActivity(intent);
    }
}