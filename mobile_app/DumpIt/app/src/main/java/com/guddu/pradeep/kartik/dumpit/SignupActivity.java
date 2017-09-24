package com.guddu.pradeep.kartik.dumpit;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.Toast;

import java.io.IOException;

import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.MultipartBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;

public class SignupActivity extends AppCompatActivity {

    private static final String TAG = SignupActivity.class.getSimpleName();
    EditText mNameEditText;
    EditText mAddressEditText;
    EditText mPasswordEditText;
    EditText mEmailEditText;
    RadioButton mOrganisationRadioButton;
    RadioButton mIndivisualRadioButton;
    Button mSubmitButton;
    String mCategory;
    EditText mContactEditText;
    private static final String USER_NAME_EXTRA = "user_name";
    private static final String REWARD_POINTS_EXTRA = "reward_points";



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        mNameEditText = (EditText) findViewById(R.id.nameEditText);
        mAddressEditText = (EditText) findViewById(R.id.addressEditText);
        mPasswordEditText = (EditText) findViewById(R.id.passwordEditText);
        mEmailEditText = (EditText) findViewById(R.id.emailEditText);
        mSubmitButton = (Button) findViewById(R.id.submitButton);
        mContactEditText = (EditText) findViewById(R.id.contactEditText);



        mSubmitButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sendFormDataToServer();
            }
        });




    }


    public void onRadioButtonClicked(View view) {
        // Is the button now checked?
        boolean checked = ((RadioButton) view).isChecked();

        // Check which radio button was clicked
        switch(view.getId()) {
            case R.id.indivisualRadioButton:
                if (checked)
                    mCategory="INDIVISUAL";
                    break;
            case R.id.organisationRadioButton:
                if (checked)

                    mCategory="ORGANISATION";
                    break;
        }
    }

    private void sendFormDataToServer() {
        if(mCategory==null){return;}

        OkHttpClient client = new OkHttpClient();

        RequestBody requestBody = new MultipartBody.Builder()
                .setType(MultipartBody.FORM)
                .addFormDataPart("name", mNameEditText.getText().toString())
                .addFormDataPart("address", mAddressEditText.getText().toString())
                .addFormDataPart("password", mPasswordEditText.getText().toString())
                .addFormDataPart("email_id",mEmailEditText.getText().toString())
                .addFormDataPart("mobile",mContactEditText.getText().toString())
                .addFormDataPart("category",mCategory)
                .build();


        final Request request = new Request.Builder()
                .url("http://192.168.43.212"+"/dumpit/signup.php")
                .post(requestBody)
                .build();

        client.newCall(request).enqueue(new Callback() {
            @Override
            public void onFailure(Call call, IOException e) {
                Log.d(TAG,"couldn't signup");
            }

            @Override
            public void onResponse(Call call, Response response) throws IOException {
                int status = Integer.parseInt(response.body().string());
                if(status == 0){
                    runOnUiThread(new Runnable() {
                        @Override
                        public void run() {
                            Toast.makeText(getApplicationContext(),"failed to create account",Toast.LENGTH_SHORT).show();
                        }
                    });
                }else if(status==1){
                    runOnUiThread(new Runnable() {
                        @Override
                        public void run() {
                            Toast.makeText(getApplicationContext(),"successfully registered",Toast.LENGTH_SHORT).show();
                        }
                    });
                    Intent intent = new Intent(getApplicationContext(),MainActivity.class);
                    intent.putExtra(USER_NAME_EXTRA,mNameEditText.getText().toString());
                    intent.putExtra(REWARD_POINTS_EXTRA,0);
                    startActivity(intent);
                }
            }
        });


    }
}
