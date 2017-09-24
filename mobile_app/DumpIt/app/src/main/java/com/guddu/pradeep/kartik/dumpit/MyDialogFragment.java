package com.guddu.pradeep.kartik.dumpit;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.DialogFragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by kartik on 24/9/17.
 */
public class MyDialogFragment extends DialogFragment implements MyRecyclerViewAdapter.ItemClickListener {
    private static final String TAG = MyDialogFragment.class.getSimpleName();
    private RecyclerView mRecyclerView;
    private RecyclerView adapter;
    private Context mContext;
    JSONArray mJsonArray;


    @Override
    public void onResume() {
        super.onResume();
     /*   int width = 400;
        int height = 400;
        getDialog().getWindow().setLayout(width, height);
    */}

    // this method create view for your Dialog
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_dialog, container, false);
        mRecyclerView = (RecyclerView) v.findViewById(R.id.recycler_view);
        //get your recycler view and populate it.


        mContext=getContext();
        String jsonArrayString = getArguments().getString("provider_array");
        JSONArray jsonArray=null;
        try {
            Log.d(TAG,jsonArrayString);
             jsonArray = new JSONArray(jsonArrayString);
             mJsonArray=jsonArray;
            Log.d(TAG,jsonArray.toString());
        } catch (JSONException e) {
            e.printStackTrace();
        }

        if(mJsonArray!=null){
            mRecyclerView.setLayoutManager(new LinearLayoutManager(mContext));
            //setadapter
            MyRecyclerViewAdapter adapter = new MyRecyclerViewAdapter(mJsonArray,mContext);//pass Context
            mRecyclerView.setAdapter(adapter);
            adapter.setClickListener(this);

        }
        //inflate layout with recycler view
        return v;
    }

    @Override
    public void onItemClick(View view, int position) {
        Log.v(TAG, "You clicked number " + position + ", which is at cell position " + position);
        JSONObject jsonObject = null;
        String providerName=null;
        String providerID=null;
        try {
            jsonObject = mJsonArray.getJSONObject(position);
            providerID=jsonObject.getString("id");
            providerName=jsonObject.getString("name");
        } catch (JSONException e) {
            e.printStackTrace();
        }
     /*   if (jsonObject != null) {
            Intent intent = new Intent(this, MovieDetailsActivity.class);
            intent.putExtra("movieJSONObject", jsonObject.toString());
            startActivity(intent);
        }*/
        if(providerID!=null && providerName!=null){
            SchedulePickupActivity callingActivity = (SchedulePickupActivity) getActivity();
            callingActivity.onUserSelectValue(providerName,providerID);
        }

        dismiss();
    }
}

