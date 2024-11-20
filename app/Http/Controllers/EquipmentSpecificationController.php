<?php

namespace App\Http\Controllers;

use App\Models\EquipmentSpecification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EquipmentSpecificationController extends Controller
{
    /**
     * Update the equipment specification.
     */

    public function update_specification(Request $request, $encrypted_equipment_id = "")
        {
            //
            $request->validate([
                                    'specification' => 'required'
                               ]);

            try {
                $equipment_id = Crypt::decryptString($encrypted_equipment_id);
            } 
            catch (DecryptException $e) {
                abort(404);
            }

            $post_data = array();

            $vendor_id = current_user_id();

            if ($request->hasFile('upload_image')) {
                    $file = $request->file('upload_image');
                    $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/uploads/', $client_original_file_name);
                    $post_data['image'] = $client_original_file_name;
            }

            $post_data['specification'] = $request->specification;

            try 
             {
                $check_record_exist = EquipmentSpecification::where('equipment_id', $equipment_id)->where('vendor_id', $vendor_id)->first();

                if ($check_record_exist == null) {
                    $post_data['equipment_id'] = $equipment_id;
                    $post_data['vendor_id'] = $vendor_id;
                    $post_data['created_at'] = date('Y-m-d H:i:s');
                    EquipmentSpecification::create($post_data);
                } else {
                    $post_data['updated_at'] = date('Y-m-d H:i:s');
                    EquipmentSpecification::where(['equipment_id' => $equipment_id, 'vendor_id' => $vendor_id])->update($post_data);
                }
            }

            catch (\Exception $e) {
                $key = 'error';
                $msg = $e->getMessage();
            }

            return redirect()->back()->with($key ?? 'message', $msg ?? 'Updated Successfully');

        }
}
