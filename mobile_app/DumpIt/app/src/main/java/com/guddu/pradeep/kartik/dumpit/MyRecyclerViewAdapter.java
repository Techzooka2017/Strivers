package com.guddu.pradeep.kartik.dumpit;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import static android.content.ContentValues.TAG;

/**
 * Created by kartik on 24/9/17.
 */

public class MyRecyclerViewAdapter extends RecyclerView.Adapter<MyRecyclerViewAdapter.ViewHolder> {

    JSONArray mJSONArray;
    LayoutInflater mLayoutInflater;
    Context mContext;
    private ItemClickListener mClickListener;


    MyRecyclerViewAdapter(JSONArray jsonArray , Context context){
        mJSONArray = jsonArray;
        mContext = context;
        mLayoutInflater = LayoutInflater.from(context);
    }

    @Override
    public MyRecyclerViewAdapter.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = mLayoutInflater.inflate(R.layout.recyclerview_item,null,false);//null to be checked
        ViewHolder viewHolder = new ViewHolder(view);
        return  viewHolder;
    }

    @Override
    public void onBindViewHolder(MyRecyclerViewAdapter.ViewHolder holder, int position) {

        if(mJSONArray!=null){

            try {
                JSONObject jsonObject = mJSONArray.getJSONObject(position );
                holder.serviceRateTextView.setText(jsonObject.getString("price"));
                holder.providerContactTextView.setText(jsonObject.getString("contact"));
                holder.providerNameTextView.setText(jsonObject.getString("name"));
            } catch (JSONException e) {
                e.printStackTrace();
            }


        }else{
            Log.d(TAG,"json array is null inside adapter");
        }

    }

    @Override
    public int getItemCount() {
       if(mJSONArray!=null){return mJSONArray.length();}

        return 0;
    }

    // stores and recycles views as they are scrolled off screen
    public class ViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener {

        public TextView providerNameTextView;
        public TextView providerContactTextView;
        public TextView serviceRateTextView;

        public ViewHolder(View itemView) {
            super(itemView);
            itemView.setOnClickListener(this);

            providerNameTextView = (TextView) itemView.findViewById(R.id.providerNameTextView);
            providerContactTextView = (TextView) itemView.findViewById(R.id.providerContactTextView);
            serviceRateTextView = (TextView) itemView.findViewById(R.id.serviceRateTextView);

        }


        @Override
        public void onClick(View view) {
            Log.i(TAG,"click event detected on viewholder");
            if (mClickListener != null) mClickListener.onItemClick(view, getAdapterPosition());

        }

    }
    // allows clicks events to be caught
    public void setClickListener(ItemClickListener itemClickListener) {
        this.mClickListener = itemClickListener;
    }

    // parent activity will implement this method to respond to click events
    public interface ItemClickListener {
        void onItemClick(View view, int position);
    }

}
