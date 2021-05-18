<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaturan;
use App\Models\slider;
use App\Models\Faq;
use DataTables;
use Carbon\Carbon;
use App\Models\jenisPelanggaran;
use App\Models\pengaduan;
use App\Models\status;



class HomeController extends Controller
{
    private $data;
    private $beritaClass;
    private $PengaturanClass;
    private $AplikasiClass;
    private $LinkTerkaitClass;
    private $galeriGambar;
    private $galeriVideo;
    private $sliderClass;
    private $galeriDetail;
    private $unduhClass;
    private $kategoriUnduh;
    private $kategoriBerita;
    private $Profil;
    private $bidangClass;
    private $subBidang;
    private $tupoksiClass;
    private $faqClass;
    private $pegawaiClass;
    private $contact;
    private $konsultasi;
    private $pertanyaan;
    private $pertanyaanIkm;
    private $kategoriPeraturan;
    private $peraturanClass;

    public function __construct()
    {
        $this->PengaturanClass = new Pengaturan;
        $this->sliderClass = new slider;
        $this->faqClass = new Faq;

        $this->data = [
            'category_name' => 'Dashboard',
            'main_url' => 'dashboard',
            'site_title' => '✅ Badan Kepegawaian Daerah Provinsi Riau - BERSIH - KOMPETEN - DISIPLIN'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['slider'] = $this->sliderClass->orderBy('created_at','desc')->get();
        return view('frontend.page.home.index',$this->data);
    }

    public function statistik()
    {
        $this->data['slider'] = $this->sliderClass->orderBy('created_at','desc')->get();
        return view('frontend.page.statistik.index',$this->data);
    }

    public function faq()
    {
        $this->data['faq'] = $this->faqClass->orderBy('id','asc')->get();
        return view('frontend.page.faqs.index',$this->data);
    }

    public function statistik_pelanggaran()
    {
        $pelanggaranName = jenisPelanggaran::orderBy('id', 'ASC')->get();
        for ($i=1; $i <= count($pelanggaranName); $i++) { 
            $pengaduan[$i] = pengaduan::where('jenis_pelanggaran_id', $i)
                ->get();            
        }
        // dd($pengaduan);        

        $dataArray = [ ];
		$pelanggaranNamesArray = [ ];        

        foreach ( $pelanggaranName as $kb )
			array_push ( $pelanggaranNamesArray, $kb->nama );

        foreach ( $pengaduan as $detail )
            array_push ( $dataArray,  count($detail));

        for($i = 0; $i < count ( $pengaduan ); $i++) {
            $chartArray  []= array (
                "name" => $pelanggaranNamesArray [$i],
                "data" => [$dataArray [$i] ]
            );
        }
		// $data['name'] = $pelanggaranNamesArray;
        // dd(json_encode($data));
        // dd($chartArray);
        return json_encode($chartArray);
    }
    
    public function status_pengaduan()
    {
        $statusName = status::orderBy('id', 'ASC')->get();
        for ($i=1; $i <= count($statusName); $i++) { 
            $pengaduan[$i] = pengaduan::where('status_id', $i)
                ->get();            
        }
        // dd($pengaduan);        

        $dataArray = [ ];
		$statusNamesArray = [ ];        

        foreach ( $statusName as $kb )
			array_push ( $statusNamesArray, $kb->nama );

        foreach ( $pengaduan as $detail )
            array_push ( $dataArray,  count($detail));

        for($i = 0; $i < count ( $pengaduan ); $i++) {
            $chartArray  []= array (
                "name" => $statusNamesArray [$i],
                "y" => $dataArray [$i]
            );
        }
		// $data['name'] = $statusNamesArray;
        // dd(json_encode($data));
        // dd($chartArray);
        return json_encode($chartArray);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
