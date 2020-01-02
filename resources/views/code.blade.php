<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>DBhelper.java</h1>
<pre>
package com.example.lenovo.model.DB;


import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import com.example.lenovo.model.UserProfile;

public class DBHelper extends SQLiteOpenHelper {

    public static final String dbname = "Model.db";

    public DBHelper(Context context) {
        super(context, dbname, null, 1);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL("CREATE TABLE "+UserProfile.Users.TABLENAME+"("+UserProfile.Users._ID+" PRIMARY KEY, "+
                UserProfile.Users.userName+" TEXT, "+ UserProfile.Users.dateOfBirth+" TEXT, "+ UserProfile.Users.Gender+" TEXT)");

    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int i, int i1) {
    db.execSQL("DROP TABLE IF EXISTS " + UserProfile.Users.TABLENAME);
    onCreate(db);
    }

    public boolean addInfo(String username){

        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();

        contentValues.put(UserProfile.Users.userName,username);
        db.insert(UserProfile.Users.TABLENAME,null,contentValues);

        return true;
    }


    public boolean updateInfor(String ID,String username,String dob,String gender){

        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put(UserProfile.Users.userName,username);
        contentValues.put(UserProfile.Users.dateOfBirth,dob);
        contentValues.put(UserProfile.Users.Gender,gender);

        long result = db.update(UserProfile.Users.TABLENAME,contentValues,"_ID=?",new String[]{ID});
        if(result==1)
            return true;
        else
            return false;
    }

    public Cursor readAllInfo(){
        SQLiteDatabase db = this.getReadableDatabase();
        return db.rawQuery("SELECT * FROM "+ UserProfile.Users.userName,null);
    }

    public int deleteInfo(){
        SQLiteDatabase db = this.getWritableDatabase();
        return db.delete(UserProfile.Users.TABLENAME,"_ID=?",new String[]{UserProfile.Users._ID});
    }


    public Cursor readAllInfo(String ID){
        SQLiteDatabase db = this.getReadableDatabase();
        return db.rawQuery("SELECT * FROM " +UserProfile.Users.userName,new String[]{ID});
    }

}

</pre>

<h2>EditProfile.java</h2>
<pre>
package com.example.lenovo.model;

import android.content.Intent;
import android.database.Cursor;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

import com.example.lenovo.model.DB.DBHelper;

public class EditProfile extends AppCompatActivity {

    DBHelper mydb;
    EditText edname2,edpassword2,eddob2;
    Button btnedit,btndelete,btnsearch;
    RadioGroup r1;
    RadioButton ma1,fe1,Rb;
    String AB;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_profile);
        edname2 = (EditText)findViewById(R.id.u3);
        edpassword2 =(EditText)findViewById(R.id.p3);
        eddob2 = (EditText)findViewById(R.id.d2);
        r1 =(RadioGroup)findViewById(R.id.rg1);
        ma1 = (RadioButton)findViewById(R.id.m1);
        fe1 =(RadioButton)findViewById(R.id.f1);
        search();
        update();
        delete();

    }

    public void search(){
        btnsearch.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        Cursor cnew = mydb.readAllInfo();
                        if (cnew == 0) {
                            showMessage("error", "Nothing to show");
                            return;
                        }
                        StringBuffer buffer = new StringBuffer();
                        while (cnew.moveToNext()) {
                            buffer.append("\n\n id" + cnew.getString(0));
                            buffer.append("\n username " + cnew.getString(1));
                            buffer.append(("\n dob" + cnew.getString(2)));
                            buffer.append("\n gender" + cnew.getString(3));
                        }
                        showMessage("Data", buffer.toString());
                    }
                });}

                public void showMessage(String Title, String Message){
                    AlertDialog.Builder builder =new AlertDialog.Builder(this);
                    builder.setCancelable(true);
                    builder.setMessage(Message);
                    builder.setTitle(Title);
                    builder.show();

                }


    public void update(){
        btnedit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                boolean upd = mydb.updateInfor(eddob2.getText().toString(),eddob2.getText().toString(),
                        r1.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
                            @Override
                            public void onCheckedChanged(RadioGroup radioGroup, int i) {
                                Rb = r1.findViewById(i);
                                switch (i){
                                    case R.id.m1:
                                        AB=ma1.getText().toString();
                                    case R.id.f1:
                                        AB=fe1.getText().toString();
                                    default:

                                }
                            }
                        }););
                if(upd ==true)
                    Toast.makeText(EditProfile.this,"Success",Toast.LENGTH_LONG).show();
                else
                    Toast.makeText(EditProfile.this,"Failure",Toast.LENGTH_LONG).show();

            }
        });
    }

    public void delete(){
        btndelete.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                int del = mydb.deleteInfo();
                if(del>0)
                    Toast.makeText(EditProfile.this,"Success",Toast.LENGTH_LONG).show();
                else
                    Toast.makeText(EditProfile.this,"Failure",Toast.LENGTH_LONG).show();
            }
        });
    }
}
</pre>
<h2>Home.java</h2>
<pre>
package com.example.lenovo.model;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.lenovo.model.DB.DBHelper;

public class Home extends AppCompatActivity {

    DBHelper mydb;
    EditText edname, edpassword;
    Button buttonlogin,buttonregister;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        edname = (EditText)findViewById(R.id.u1);
        edpassword = (EditText)findViewById(R.id.p1);
        buttonlogin = (Button)findViewById(R.id.l1);
        buttonregister = (Button)findViewById(R.id.r1);
        add();

        buttonregister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(Home.this,ProfileManagement.class));
            }
        });
    }

    private void add() {

        buttonregister.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        boolean insertinto = mydb.addInfo(edname.getText().toString());

                        if(insertinto==true)
                            Toast.makeText(Home.this,"Success",Toast.LENGTH_LONG).show();
                        else
                            Toast.makeText(Home.this,"Failure",Toast.LENGTH_LONG).show();

                    }
                }
        );
    }


}</pre>

<h2>Mainfest</h2>
<pre>
?xml version="1.0" encoding="utf-8"?
<manifest xmlns:android="http://schemas.android.com/apk/res/android"
    package="com.example.lenovo.model">

    <application
        android:allowBackup="true"
        android:icon="@mipmap/ic_launcher"
        android:label="@string/app_name"
        android:roundIcon="@mipmap/ic_launcher_round"
        android:supportsRtl="true"
        android:theme="@style/AppTheme">
        <activity android:name=".Home">
            <intent-filter>
                <action android:name="android.intent.action.MAIN" />

                <category android:name="android.intent.category.LAUNCHER" />
            </intent-filter>
        </activity>
        <activity android:name=".EditProfile">
            <intent-filter>
                <action android:name="android.intent.action.EditProfile" />

                <category android:name="android.intent.category.DEFAULT" />
            </intent-filter>

        </activity>
        <activity android:name=".ProfileManagement">
            <intent-filter>
                <action android:name="android.intent.action.ProfileManagement" />

                <category android:name="android.intent.category.DEFAULT" />
            </intent-filter>

        </activity>
    </application>

</manifest></pre>

<h2>ProfileManagement</h2>
<pre>
package com.example.lenovo.model;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;

import com.example.lenovo.model.DB.DBHelper;

public class ProfileManagement extends AppCompatActivity{

    DBHelper mydb;
    EditText edname1, edpassword1,eddob;
    Button btnupdateprofile;
    RadioGroup r2;
    RadioButton m2,f2;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile_management);

        edname1 = (EditText)findViewById(R.id.u3);
        edpassword1 =(EditText)findViewById(R.id.p3);
        eddob =(EditText)findViewById(R.id.d2);
        btnupdateprofile = (Button)findViewById(R.id.up1);
        r2 = (RadioGroup)findViewById(R.id.rg2);
        m2= (RadioButton)findViewById(R.id.m1);
        f2 = (RadioButton)findViewById(R.id.f1);


        btnupdateprofile.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        startActivity(new Intent(ProfileManagement.this,EditProfile.class));
                    }
                }


        );

    }




}</pre>

<h2>UserProfile</h2>
<pre>
package com.example.lenovo.model;


import android.provider.BaseColumns;

public final class UserProfile {

    private int ID;
    private String username;
    private String password;
    private boolean gender;
    private String dob;

    public UserProfile() {
    }

    public int getID() {
        return ID;
    }

    public void setID(int ID) {
        this.ID = ID;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public boolean isGender() {
        return gender;
    }

    public void setGender(boolean gender) {
        this.gender = gender;
    }

    public String getDob() {
        return dob;
    }

    public void setDob(String dob) {
        this.dob = dob;
    }

    public class Users implements BaseColumns{

        public static final String TABLENAME = "UserInfo" ;
        public static final String _ID = "ID" ;
        public static final String userName = "username";
        public static final String dateOfBirth= "dob";
        public static final String Gender="gender";
    }

}
</pre>
</body>
</html>

