<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;

class ConfigurationManagementController extends Controller
{
	public function getFieldsOfTask(){

		return response()->json([
			[
				'type-task'=> 'recurrent task', 
			    'fields' => [
							'name',
							'description',
							'doer',
							'coDoer',
							'reviewer',
							'creator',
							'department',
							'coDepartments',
							'labelIds',
							'start',
							'finish',
							'due',
							'comment',
							'percentComplete',
							'type',
							'status'
							]
			],
			[
				'type-task'=> 'procedural task', 
			    'fields' => [
							'name',
							'content',
							'deadline',
							'status',
							'finished_at',
							'amount_of_work',
							'amount_of_accomplished_work',
							'main_task_id',
							'creator',
							'implementer',
							'step',
							'created_at',
							'updated_at'
							]
			]
		]);
	}


	public function createTemplate(Request $request){
		$template = new Template;
		$template->name = $request->name;
		$fields_json = json_encode(['fields' => $request->fields]);
		$template->fields = $fields_json;
		$template->save();

		return response()->json(['message'=>'Create template successfully!','template'=> $template]);

	}


	public function getTemplate($id) {
		$template = Template::find($id);
		if (!$template) {
			return response()->json(['message'=>'template does not exist!']);
		} else {
			$template->fields = json_decode($template->fields)->fields;
			return response()->json($template);
		}
	}

	public function updateTemplate(Request $request, $id) {
		$template = Template::find($id);
		if (!$template) {
			return response()->json(['message'=>'template does not exist!']);
		} else {
			$template->name = $request->name;
			$fields_json = json_encode(['fields' => $request->fields]);
			$template->fields = $fields_json;
			$template->save();
			return response()->json(['message'=>'Update the template successfully!','template'=> $template]);
		}
	}
}
