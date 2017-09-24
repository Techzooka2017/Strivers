package com.guddu.pradeep.kartik.dumpit;

import android.app.DatePickerDialog;
import android.app.Fragment;
import android.app.FragmentTransaction;
import android.app.TimePickerDialog;
import android.support.v4.app.DialogFragment;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.TextView;
import android.widget.TimePicker;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.Calendar;

import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.MultipartBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;

public class SchedulePickupActivity extends AppCompatActivity {


    private static final String TAG = SchedulePickupActivity.class.getSimpleName();
    EditText mStartDateEditText;
    EditText mEndDateEditText;
    EditText mTimeEditText;
    TextView mServiceProviderTextView;
    String mFrequency;
    Button mScheduleAndPayLaterButton;
    Button mSelectServiceProviderButton;
    Button mScheduleAndPayNowButton;
    DatePickerDialog mDatePickerDialog;
    JSONObject mServerResponse;
    JSONArray mServiceProvidersJSONArray;
    private static final String BASE_URL = "http://192.168.43.212";
    private String mSelectedServiceProviderID;
    private static final String EMAIL_EXTRA = "email_id";
    private String mUserEmail ;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_schedule_pickup);

        mUserEmail = getIntent().getStringExtra(EMAIL_EXTRA);


        mStartDateEditText = (EditText) findViewById(R.id.startDatePickerEditText);
        mEndDateEditText = (EditText) findViewById(R.id.endDatePickerEditText);
        mTimeEditText = (EditText) findViewById(R.id.timePickerEditText);
        mServiceProviderTextView = (TextView) findViewById(R.id.serviceProviderTextView);
        mScheduleAndPayLaterButton = (Button) findViewById(R.id.scheduleAndPayLaterButton);
        mScheduleAndPayNowButton = (Button) findViewById(R.id.scheduleAndPayNowButton);
        mSelectServiceProviderButton= (Button) findViewById(R.id.selectServiceProviderButton);


        mStartDateEditText.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // calender class's instance and get current date , month and year from calender
                final Calendar c = Calendar.getInstance();
                int mYear = c.get(Calendar.YEAR); // current year
                int mMonth = c.get(Calendar.MONTH); // current month
                int mDay = c.get(Calendar.DAY_OF_MONTH); // current day
                // date picker dialog
                mDatePickerDialog = new DatePickerDialog(SchedulePickupActivity.this,
                        new DatePickerDialog.OnDateSetListener() {

                            @Override
                            public void onDateSet(DatePicker view, int year,
                                                  int monthOfYear, int dayOfMonth) {
                                // set day of month , month and year value in the edit text
                                mStartDateEditText.setText(dayOfMonth + "/"
                                        + (monthOfYear + 1) + "/" + year);

                            }
                        }, mYear, mMonth, mDay);
                mDatePickerDialog.show();

            }
        });


        mScheduleAndPayLaterButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sendRequest();
            }
        });

        mScheduleAndPayNowButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sendRequest();
            }
        });



        mEndDateEditText.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // calender class's instance and get current date , month and year from calender
                final Calendar c = Calendar.getInstance();
                int mYear = c.get(Calendar.YEAR); // current year
                int mMonth = c.get(Calendar.MONTH); // current month
                int mDay = c.get(Calendar.DAY_OF_MONTH); // current day
                // date picker dialog
                mDatePickerDialog = new DatePickerDialog(SchedulePickupActivity.this,
                        new DatePickerDialog.OnDateSetListener() {

                            @Override
                            public void onDateSet(DatePicker view, int year,
                                                  int monthOfYear, int dayOfMonth) {
                                // set day of month , month and year value in the edit text
                                mEndDateEditText.setText(dayOfMonth + "/"
                                        + (monthOfYear + 1) + "/" + year);

                            }
                        }, mYear, mMonth, mDay);
                mDatePickerDialog.show();
            }
        });


        mTimeEditText.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Calendar mcurrentTime = Calendar.getInstance();
                int hour = mcurrentTime.get(Calendar.HOUR_OF_DAY);
                int minute = mcurrentTime.get(Calendar.MINUTE);
                final TimePickerDialog mTimePicker;
                mTimePicker = new TimePickerDialog(SchedulePickupActivity.this, new TimePickerDialog.OnTimeSetListener() {
                    @Override
                    public void onTimeSet(TimePicker timePicker, int selectedHour, int selectedMinute) {
                        mTimeEditText.setText( selectedHour + ":" + selectedMinute);
                    }
                }, hour, minute, true);//Yes 24 hour time
                mTimePicker.setTitle("Select Time");
                mTimePicker.show();
            }
        });

        mSelectServiceProviderButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(mServiceProvidersJSONArray==null){
                    getServiceProviders();
                }else{
                    showProviderDialog(mServiceProvidersJSONArray);
                }

            }
        });




    }

    private void sendRequest() {
        OkHttpClient client = new OkHttpClient();

        RequestBody requestBody = new MultipartBody.Builder()
                .setType(MultipartBody.FORM)
                .addFormDataPart("user_id", mUserEmail)
                .addFormDataPart("sp_id", mSelectedServiceProviderID)
                .addFormDataPart("start_date",mStartDateEditText.getText().toString())
                .addFormDataPart("end_date",mEndDateEditText.getText().toString())
                .addFormDataPart("pickup_time",mTimeEditText.getText().toString())
                .addFormDataPart("frequency",mFrequency)
                .build();


        final Request request = new Request.Builder()
                .url(BASE_URL+"/dumpit/request_pickup.php")
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
                if(body.equals("1")){
                    //success
                    runOnUiThread(new Runnable() {
                        @Override
                        public void run() {
                            Toast.makeText(getApplicationContext(),"successfuly raised the request",Toast.LENGTH_SHORT).show();
                            finish();
                        }
                    });
                }else{
                    runOnUiThread(new Runnable() {
                        @Override
                        public void run() {
                            Toast.makeText(getApplicationContext(),"couldn't raise the request , please try again",Toast.LENGTH_SHORT).show();
                        }
                    });
                    //failiure
                }

            }
        });


    }

    private void getServiceProviders() {
        OkHttpClient client = new OkHttpClient();

        RequestBody requestBody = new MultipartBody.Builder()
                .setType(MultipartBody.FORM)
                .addFormDataPart("list","placeholder")
                .build();


        final Request request = new Request.Builder()
                .url(BASE_URL+"/dumpit/service_provider.php")
                .post(requestBody)
                .build();

        client.newCall(request).enqueue(new Callback() {
            @Override
            public void onFailure(Call call, IOException e) {
                Log.d(TAG,"couldn't fetch service providers from server");
            }

            @Override
            public void onResponse(Call call, Response response) throws IOException {

                String responseString = response.body().string();
                Log.d(TAG,responseString);

                try {
                    mServerResponse = new JSONObject(responseString);

                    mServiceProvidersJSONArray = mServerResponse.getJSONArray("provider");
                    showProviderDialog(mServiceProvidersJSONArray);
                } catch (JSONException e) {
                    e.printStackTrace();
                }



            }
        });



    }

    private void showProviderDialog(JSONArray mServiceProvidersJSONArray) {
        FragmentTransaction ft = getFragmentManager().beginTransaction();
        MyDialogFragment myDialogFragment = new MyDialogFragment();
        Fragment prev = getFragmentManager().findFragmentByTag("dialog");
        if (prev != null) {
            ft.remove(prev);
        }
        ft.addToBackStack(null);
        Bundle bundle = new Bundle();
        Log.i(TAG,mServiceProvidersJSONArray.toString());
        bundle.putString("provider_array",mServiceProvidersJSONArray.toString());
        //bundle.putCharArray("provider_array",mServiceProvidersJSONArray.toString().toCharArray());
        myDialogFragment.setArguments(bundle);
        myDialogFragment.show(getSupportFragmentManager(),"dialog");

        // Create and show the dialog.
       // myDialogFragment.show(ft,"dialog");
//getView().findViewById(R.id.MyGridContainer).setVisibility(View.VISIBLE);
        ft.commit();

    }

    public void onUserSelectValue(String serviceProviderName,String serviceProviderID) {
        mServiceProviderTextView.setText(serviceProviderName);
        mSelectedServiceProviderID = serviceProviderID;
        // TODO add your implementation.
        Toast.makeText(getBaseContext(), ""+ serviceProviderName, Toast.LENGTH_LONG).show();
    }

    public void onRadioButtonClicked(View view) {
        // Is the button now checked?
        boolean checked = ((RadioButton) view).isChecked();

        // Check which radio button was clicked
        switch(view.getId()) {
            case R.id.onceRadioButton:
                if (checked)
                    mFrequency="ONCE";
                    mEndDateEditText.setEnabled(false);
                break;
            case R.id.weeklyRadioButton:
                if (checked)
                    mEndDateEditText.setEnabled(true);
                    mFrequency="WEEKLY";
                break;
            case R.id.monthlyRadioButton:
                if (checked)
                    mEndDateEditText.setEnabled(true);
                    mFrequency="MONTHLY";
                break;
            case R.id.dailyRadioButton:
                if (checked)
                    mEndDateEditText.setEnabled(true);
                    mFrequency="DAILY";
                break;

        }
    }


}
