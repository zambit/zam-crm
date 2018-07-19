<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\AddToWlRequest;
use App\Models\Investors;
use Dotzero\LaravelAmoCrm\AmoCrmManager;

//TODO Fix custom request

class InvestorController extends Controller
{

    public $investor = array();

    /**
     * Add investor to whitelist database
     *
     * @param AddToWlRequest $request
     * @param AmoCrmManager $amocrm
     */
//    public function addToWl(AddToWlRequest $request)
    public function addToWl(Request $request, AmoCrmManager $amocrm)
    {
        //TODO Catch errors
        $data = $request->all();
        $json = collect(json_decode($data['data']))->forget('code');
        $phone = $json->get('phoneFull');
        $json->put('phone', $phone);
        $json->put('ip', $request->ip());
        $investor = $json->toArray();
        Investors::create($investor);

        $person = Investors::where('phone', $phone);

        $person = $person->first();

        //TODO Do it with correct WAY!!!
        //Add new Lead
        $lead = $amocrm->lead;
        $lead['name'] = "Whitelist - $person->id";
        $lead['tag'] = ['whitelist', 'ico-landing'];
        $id = $lead->apiAdd();

        //Add new contact
        $contact = $amocrm->contact;
        $contact['name'] = $person->phone;
        $contact['tag'] = ['whitelist', 'ico-landing'];
        $contact->addCustomField(69005, [
            [$person->phone, 'WORK']
        ]);
        $contact->addCustomField(69007, [
            [$person->email, 'WORK']
        ]);
        $contact->addCustomField(69011, [
            [$person->telegram, 'OTHER']
        ]);
        $contact->addCustomField(132327, [
            [$person->country, 'COUNTRY']
        ]);
        $contact['linked_leads_id'] = $id;
        $p_id = $contact->apiAdd();

        return "$p_id successful added";
    }

    /**
     * Add to AmoCrm
     *
     * @param AmoCrmManager $amocrm
     * @param array $investor
     * @return string
     */
    protected function addToCrm(AmoCrmManager $amocrm)
    {
        try {
            //Add new Lead
            $lead = $amocrm->lead;
            $lead['name'] = $investor['phone'];
            $id = $lead->apiAdd();

            //Add new contact
            $contact = $amocrm->contact;
            $contact['name'] = $investor['phone'];
            $contact->addCustomField(69005, [
                [$investor['phone'], 'WORK']
            ]);
            $contact->addCustomField(69007, [
                [$investor['email'], 'WORK']
            ]);
            $contact->addCustomField(69011, [
                [$investor['telegram'], 'OTHER']
            ]);
            $contact['linked_leads_id'] = $id;
            $person = $contact->apiAdd();

            return "$person successful added";

        } catch (\Exception $e) {
            abort(400, $e->getMessage());
        }

    }
}
