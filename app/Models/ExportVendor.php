<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;
use Fickrr\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection;
/*use Maatwebsite\Excel\Concerns\WithHeadings;*/
/*class ExportProduct implements FromCollection, WithHeadings*/

class ExportVendor implements FromCollection
{

   protected $table = 'users';
   
   public function collection()
    {
       return Users::getvendorData();

      

    }
  
    public function headings(): array{




        return [
            'id',
            'provider',
            'provider_id',
            'name',
			'username',
			'email',
			'email_verified_at',
			'user_type',
			'user_photo',
			'user_banner',
			'user_token',
			'website',
			'country',
			'profile_heading',
			'about',
			'phonenumber',
			'facebook_url',
			'twitter_url',
			'youtube',
			'instagram',
			'gplus_url',
			'verified',
			'user_permission',
			'item_update_email',
			'item_comment_email',
			'item_review_email',
			'buyer_review_email',
			'user_freelance',
			'country_badge',
			'exclusive_author',
			'remember_token',
			'referral_by',
			'referral_amount',
			'referral_count',
			'created_at',
			'updated_at',
			'drop_status',
			
		
			
			
        ];
    }

  
}
