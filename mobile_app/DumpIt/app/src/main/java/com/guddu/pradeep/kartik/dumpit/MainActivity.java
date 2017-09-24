package com.guddu.pradeep.kartik.dumpit;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {


    private static final String USER_NAME_EXTRA = "user_name";
    private static final String REWARD_POINTS_EXTRA = "reward_points";
    private static final String EMAIL_EXTRA = "email_id";



    TextView mWelcomeTextView;
    TextView mRewardPointsTextView;
    Button mSchedulePickupButton;
    Button mShowUpcomingPickupsButton;
    Button mShowPastPickupsButton;
    Button mEarnRewardsButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        mWelcomeTextView = (TextView) findViewById(R.id.welcomeTextView);
        mRewardPointsTextView = (TextView) findViewById(R.id.rewardPointsTextView);

        mWelcomeTextView.setText("Hi "+getIntent().getStringExtra(USER_NAME_EXTRA));
        mRewardPointsTextView.setText("You have "+getIntent().getStringExtra(REWARD_POINTS_EXTRA)+" points");


        mSchedulePickupButton = (Button) findViewById(R.id.raiseRequestButton);
        mShowPastPickupsButton = (Button) findViewById(R.id.pastPickupsButton);
        mShowUpcomingPickupsButton = (Button) findViewById(R.id.showUpcomingPickupButton);
        mEarnRewardsButton= (Button) findViewById(R.id.earnRewardsButton);

        mSchedulePickupButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(),SchedulePickupActivity.class);
                intent.putExtra(EMAIL_EXTRA,getIntent().getStringExtra(EMAIL_EXTRA));
                startActivity(intent);

            }
        });

        mEarnRewardsButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(),RewardsActivity.class);
                startActivity(intent);

            }
        });

    }
}
