<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WorkerExport implements FromQuery, WithHeadings
{
    use Exportable;

    public $dates = null;
    public function setDates(string $dates)
    {
        $this->dates = $dates;
    }

    public function query()
    {
        return Registration::join('reg_nominee', 'registration.id', '=', 'reg_nominee.worker_id')
        ->where('registration.del', 0)
        ->where('reg_nominee.del', 0)
        ->when($this->dates, function($q){
            return $q->where(\DB::raw('DATE(registration.created_at)'), '>=' ,  \App\DateRange::date($this->dates)->from)
            ->where(\DB::raw('DATE(registration.created_at)'), '<=' ,  \App\DateRange::date($this->dates)->to);
        })
        ->select(
            'registration.id',
            'registration.system_id',
            'registration.name',
            'registration.father',
            'registration.mother',
            'registration.marital',
            'registration.spouse',
            'registration.gender',
            'registration.dob',
            'registration.cast',
            'registration.tribe',
            'registration.email',
            'registration.phone',
            'registration.bg',
            'registration.city_t',
            'registration.district_t',
            'registration.district_t_code',
            'registration.state_t',
            'registration.state_t_code',
            'registration.pin_t',
            'registration.po_t',
            'registration.ps_t',
            'registration.address_t',
            'registration.city_p',
            'registration.district_p',
            'registration.district_p_code',
            'registration.state_p',
            'registration.state_p_code',
            'registration.pin_p',
            'registration.po_p',
            'registration.ps_p',
            'address_p',
            'registration.aadhaar',
            'registration.pf_no',
            'registration.nature',
            'registration.serial',
            'registration.serial_date',
            'registration.doe',
            'registration.dor',
            'registration.turnover',
            'registration.total_years',
            'registration.est_name',
            'registration.est_reg_no',
            'registration.est_address',
            'registration.employer_name',
            'registration.employer_address',
            'registration.other_welfare',
            'registration.welfare_name',
            'registration.welfare_reg_no',
            'registration.more_bocw',
            'registration.number_of_bocw',
            'registration.primary_bocw',
            'reg_nominee.nominee_name1',
            'reg_nominee.nominee_dob1',
            'reg_nominee.nominee_aadhaar1',
            'reg_nominee.nominee_relation1',
            'reg_nominee.nominee_address1',
            'reg_nominee.nominee_name2',
            'reg_nominee.nominee_dob2',
            'reg_nominee.nominee_aadhaar2',
            'reg_nominee.nominee_relation2',
            'reg_nominee.nominee_address2'
        );
    }
    public function headings(): array
    {
        return [
            'ID',
            'System ID',
            'Name',
            'Father',
            'Mother',
            'Marital Status',
            'Spouse',
            'Gender',
            'Date of Birth',
            'Caste',
            'Tribe',
            'Email',
            'Phone',
            'Blood Group',
            'City (Temporary)',
            'District (Temporary)',
            'District Code (Temporary)',
            'State (Temporary)',
            'State Code (Temporary)',
            'PIN (Temporary)',
            'Post Office (Temporary)',
            'Police Station (Temporary)',
            'Address (Temporary)',
            'City (Permanent)',
            'District (Permanent)',
            'District Code (Permanent)',
            'State (Permanent)',
            'State Code (Permanent)',
            'PIN (Permanent)',
            'Post Office (Permanent)',
            'Police Station (Permanent)',
            'Address (Permanent)',
            'Aadhaar Number',
            'ESI/PF Number',
            'Nature of Work',
            'Old Registration Number',
            'Old Registration Date',
            'Date of Enrollment',
            'Date of Retirement',
            'Annual income',
            'Total years of service',
            'Establishment Name',
            'Establishment registration number',
            'Establishment Address',
            'Employer Name',
            'Employer Address',
            'Associated with Other Welfare Scheme',
            'Welfare Scheme Name',
            'Welfare Scheme Registration Number',
            'More than One BOCW Registration',
            'Number of BOCW Registrations',
            'Primary BOCW Registration',
            'Nominee Name 1',
            'Nominee Date of Birth 1',
            'Nominee Aadhaar Number 1',
            'Nominee Relation 1',
            'Nominee Address 1',
            'Nominee Name 2',
            'Nominee Date of Birth 2',
            'Nominee Aadhaar Number 2',
            'Nominee Relation 2',
            'Nominee Address 2',
            
        ];
    }
}

