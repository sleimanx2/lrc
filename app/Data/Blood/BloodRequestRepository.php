<?php


namespace LRC\Data\Blood;


class BloodRequestRepository {


    /**
     * @var BloodRequest
     */
    private $bloodRequest;

    /**
     * @param BloodRequest $bloodRequest
     */
    function __construct(BloodRequest $bloodRequest)
    {
        $this->bloodRequest = $bloodRequest;
    }

    public function findOrFail($id)
    {
        return $this->bloodRequest->findOrFail($id);
    }

    /**
     * Finds blood requests paginated
     * @param int $limit
     * @return mixed
     */
    public function getPaginated($limit = 25)
    {
        $bloodRequests = $this->bloodRequest->with('blood_type', 'blood_bank')->paginate($limit);

        return $bloodRequests;

    }

    public function searchPaginated($query, $limit = 25)
    {
        $query = str_replace(" ", "%", '%' . $query . '%');

        $bloodRequests = $this->bloodRequest
            ->select('*')
            ->with('blood_type', 'blood_bank')
            ->where('patient_name', 'like', $query)
            ->paginate($limit);

        return $bloodRequests;
    }

    public function store($data)
    {
        $attributes = [
            'patient_name'       => $data['patient_name'],
            'due_date'           => $data['due_date'],
            'blood_type_id'      => $data['blood_type_id'],
            'blood_bank_id'      => $data['blood_bank_id'],
            'blood_quantity'     => $data['blood_quantity'],
            'platelets_quantity' => $data['platelets_quantity'],
            'contact_name'       => $data['contact_name'],
            'phone_primary'      => $data['phone_primary'],
            'phone_secondary'    => $data['phone_secondary'],
            'case'               => $data['case'],
            'user_id'            => $data['user_id'],
            'completed'          => 0,
            'patient_gender'     => $data['patient_gender'],
        ];

        return $this->bloodRequest->create($attributes);
    }

    public function update($data, BloodRequest $bloodRequest)
    {
        $attributes = [
            'patient_name'       => $data['patient_name'],
            'due_date'           => $data['due_date'],
            'blood_type_id'      => $data['blood_type_id'],
            'blood_bank_id'      => $data['blood_bank_id'],
            'blood_quantity'     => $data['blood_quantity'],
            'platelets_quantity' => $data['platelets_quantity'],
            'contact_name'       => $data['contact_name'],
            'phone_primary'      => $data['phone_primary'],
            'phone_secondary'    => $data['phone_secondary'],
            'case'               => $data['case'],
            'user_id'            => $data['user_id'],
            'patient_gender'     => $data['patient_gender'],
        ];

        $bloodRequest->fill($attributes);

        $bloodRequest->save();
    }

    public function destroy($id)
    {
        return $this->bloodRequest->destroy($id);
    }
}