package com.guddu.pradeep.kartik.dumpit;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.guddu.pradeep.kartik.dumpit.R;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.MultipartBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;

public class LoginActivity extends AppCompatActivity {



    private static final String USER_NAME_EXTRA = "user_name";
    private static final String REWARD_POINTS_EXTRA = "reward_points";
    private static final String TAG = LoginActivity.class.getSimpleName();
    private static final String BASE_URL = "http://192.168.43.212";
    private static final String EMAIL_EXTRA = "email_id";
    EditText mEmailIdEditText;
    EditText mPasswordEditText;
    Button mLoginButton;
    Button mSignupButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        mEmailIdEditText= (EditText) findViewById(R.id.emailIdEditText);
        mPasswordEditText = (EditText) findViewById(R.id.passwordEditText);

        mLoginButton = (Button) findViewById(R.id.loginButton);
        mSignupButton = (Button) findViewById(R.id.signupButton);

        mLoginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
               String email = mEmailIdEditText.getText().toString();
                String password = mPasswordEditText.getText().toString();
                authenticate(email,password);
            }
        });

        mSignupButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(),SignupActivity.class);
                startActivity(intent);
            }
        });

    }

    private void authenticate(String email, String password) {
        OkHttpClient client = new OkHttpClient();

        RequestBody requestBody = new MultipartBody.Builder()
                .setType(MultipartBody.FORM)
                .addFormDataPart("email_id", email)
                .addFormDataPart("password", password)
                .build();


        final Request request = new Request.Builder()
                .url(BASE_URL+"/dumpit/login.php")
                .post(requestBody)
                .build();

        client.newCall(request).enqueue(new Callback() {
            @Override
            public void onFailure(Call call, IOException e) {
                Log.d(TAG,"couldn't connect to server / failed login");
            }

            @Override
            public void onResponse(Call call, Response response) throws IOException {

                String body = response.body().string();
                Log.d(TAG,body);
                JSONObject jsonObject;
                int status=0;
                try {
                    jsonObject = new JSONObject(body);
                    status = Integer.parseInt(jsonObject.getString("status"));

                    if(status==0){
                        Log.i(TAG,"failed to login");
                    }else {
                        Log.i(TAG,"successfully  logged in");

                    }

                    gotoMainActivity(
                                        jsonObject.getString("name"),
                                        jsonObject.getString("reward_point")
                                                                                 );



                } catch (JSONException e) {
                    Log.d(TAG,"The response is in not in JSON format");
                    e.printStackTrace();
                }
            }
        });


    }

    private void gotoMainActivity(String name, String reward_points) {
        Intent intent = new Intent(this,MainActivity.class);
        intent.putExtra(USER_NAME_EXTRA,name);
        intent.putExtra(REWARD_POINTS_EXTRA,reward_points);
        intent.putExtra(EMAIL_EXTRA,mEmailIdEditText.getText().toString());
        startActivity(intent);
    }
}
