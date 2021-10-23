<?php

function get_ed($pusat_cluster, $nilai)
{
	$arr = array();
	foreach ($pusat_cluster as $key => $val) {
		foreach ($val as $k => $v) {
			$arr[$key] += pow($v - $nilai[$k], 2);
		}
		$arr[$key] = sqrt($arr[$key]);
	}
	return $arr;
}
/**
 * Merangking data total
 * @param array $array data total yang belum terurut
 * @return array data yang sudah terurut
 **/
function get_rank($array)
{
	//menyimpan $array ke variabel $data
	$data = $array;
	//mengurutkan $data dari nilai terbesar ke terkecil dengan tetap mempertakankan key dari array
	arsort($data);
	//no untuk memberi ranking
	$no = 1;
	//variabel data yang sudah dirangking
	$new = array();
	foreach ($data as $key => $value) {
		//memberikan rangking, sekaligus increment $no
		$new[$key] = $no++;
	}
	return $new;
}
/**
 * Mengambil data nilai alternatif per atribut di database
 * dan menyimpan dalam bentuk array
 * @param string $search query pencarian berdasarkan kode atau nama alternatif
 * @return array data nilai
 **/
function get_hasil_analisa($cluster)
{
	//variabel glogal untuk database
	global $db;
	//mengampil data nilai di database    
	$rows = $db->get_results("SELECT *
		FROM tb_rel_alternatif
		WHERE kode_alternatif IN (SELECT kode_alternatif FROM tb_cluster WHERE cluster='$cluster')
		ORDER BY kode_alternatif, kode_atribut");
	$data = array();
	//perulangan $rows 
	foreach ($rows as $row) {
		//menyimpan ke dalam array 2 dimensi
		$data[$row->kode_alternatif][$row->kode_atribut] = $row->nilai;
	}
	return $data;
}
/**
 * Mengambil data nilai alternatif per atribut di database
 * dan menyimpan dalam bentuk array
 * @param string $search query pencarian berdasarkan kode atau nama alternatif
 * @return array data nilai
 **/
function get_rel_alternatif($cluster)
{
	//variabel glogal untuk database
	global $db;
	//mengampil data nilai di database    
	$rows = $db->get_results("SELECT *
		FROM tb_rel_alternatif
		WHERE kode_alternatif IN (SELECT kode_alternatif FROM tb_cluster WHERE cluster='$cluster')
		ORDER BY kode_alternatif, kode_atribut");
	$data = array();
	//perulangan $rows 
	foreach ($rows as $row) {
		//menyimpan ke dalam array 2 dimensi
		$data[$row->kode_alternatif][$row->kode_atribut] = $row->nilai;
	}
	return $data;
}
/**
 * Menormalisasikan data nilai
 * @param array $array data nilai
 * @return array data yang sudah normal
 **/
function get_nomalize($array)
{
	$data = array();
	$kuadrat = array();

	//perulangan $array        
	foreach ($array as $key => $value) {
		foreach ($value as $k => $v) {
			//mentotalkan hasil kuadrat dari setiap elemen $array
			$kuadrat[$k] += ($v * $v);
		}
	}
	//perulangan $array
	foreach ($array as $key => $value) {
		foreach ($value as $k => $v) {
			//membagi setiap element $array dengan akar kuadrat
			$data[$key][$k] = $v / sqrt($kuadrat[$k]);
		}
	}
	return $data;
}
/**
 * Mengalikan data normal dengan bobot atribut
 * @param array $array data normal
 * @return array data normal terbobot
 **/
function get_nomal_terbobot($array, $bobot_normal)
{
	$data = array();

	foreach ($array as $key => $value) {
		foreach ($value as $k => $v) {
			$data[$key][$k] = $v * $bobot_normal[$k];
		}
	}
	return $data;
}
/**
 * mencari bobot normal
 * @param array $array data normal
 * @return array data normal terbobot
 **/
function get_bobot_normal($nilai)
{
	global $KRITERIA;
	$arr = array();
	$total = array_sum($nilai);
	foreach ($nilai as $key => $val) {
		$arr[$key] = $val / $total;
	}
	return $arr;
}
/**
 * Mencari solusi ideal
 * @param array $array data normal terbobot
 * @return array solusi ideal positif dan negatif
 **/
function get_solusi_ideal($array)
{
	//memanggil variabel global KRITERIA
	global $KRITERIA;
	$data = array();
	$temp = array();

	//membalik (transpose ) array
	foreach ($array as $key => $value) {
		foreach ($value as $k => $v) {
			$temp[$k][] = $v;
		}
	}
	//perulangan sesuai $temp
	foreach ($temp as $key => $value) {
		//nilai terbesar setiap data per atribut
		$max = max($value);
		//nilai terkecil setiap data per atribut
		$min = min($value);
		//jika atribut benefit
		if ($KRITERIA[$key]->atribut == 'benefit') {
			//solusi positif adalah yang terbesar, negatif adalah yang terkecil
			$data['positif'][$key] = $max;
			$data['negatif'][$key] = $min;
		}
		//jika atribut cost
		else {
			//solusi positif adalah yang terkecil, negatif adalah yang terbesar
			$data['positif'][$key] = $min;
			$data['negatif'][$key] = $max;
		}
	}

	return $data;
}
/**
 * Mencari jarak solusi ideal
 * @param array $array data normal terbobot
 * @param array $ideal solusi ideal positif dan negatif
 * @return array jarak solusi ideal positif dan negatif
 **/
function get_jarak_solusi($array, $ideal)
{
	// array temporary   
	$temp = array();
	//perulangan sesuai $array
	foreach ($array as $key => $value) {
		foreach ($value as $k => $v) {
			//mengurangkan setiap elemen $array dengan $ideal, kemudian dikuadratkan
			$temp[$key]['positif'] += ($v - $ideal['positif'][$k]) * ($v - $ideal['positif'][$k]);
			$temp[$key]['negatif'] += ($v - $ideal['negatif'][$k]) * ($v - $ideal['negatif'][$k]);
		}
		//mengakarkan total hasil pengurangan
		$temp[$key]['positif'] = sqrt($temp[$key]['positif']);
		$temp[$key]['negatif'] = sqrt($temp[$key]['negatif']);
	}
	return $temp;
}

function get_preferensi($array)
{
	global $KRITERIA;
	$temp = array();
	foreach ($array as $key => $value) {
		if (($value['positif'] + $value['negatif']) == 0)
			$temp[$key] = 0;
		else
			$temp[$key] = $value['negatif'] / ($value['positif'] + $value['negatif']);
	}
	return $temp;
}


/**
 * 
 */
class fcm
{
	protected $data;
	protected $cluster_count;
	protected $max_iterasi;
	protected $pembobot;
	protected $epsilon;

	public $cluster;
	protected $random_cluster;

	public $iterasi = 1;
	protected $is_debug = true;

	public $keanggotaan;
	protected $miu_kuadat;
	protected $miu_kuadat_x;
	public $pusat_cluster;
	protected $xv;
	protected $nilai_l;
	protected $lt;
	protected $fungsi_objektif;
	public $hasil;

	function __construct($data, $max_iterasi, $cluster_count, $pembobot, $epsilon)
	{
		$this->data = $data;
		$this->max_iterasi = $max_iterasi;
		$this->cluster_count = $cluster_count;
		$this->pembobot = $pembobot;
		$this->epsilon = $epsilon;

		for ($a = 1; $a <= $this->cluster_count; $a++) {
			$this->cluster['C' . $a] = 'C' . $a;
		}
		$this->random_cluster();
		$this->hitung();
	}
	function hitung()
	{
		$success = false;
		$this->keanggotaan = $this->random_cluster;
		while (!$success && $this->iterasi <= $this->max_iterasi) {
			$this->dd("\n<b>Iterasi $this->iterasi</b>");
			$this->dd("\n<b>Keanggotaan $this->iterasi</b>");
			foreach ($this->keanggotaan as $key => $val) {
				$this->dd("\n$key: ");
				foreach ($val as $k => $v) {
					$this->dd("\t" . round($v, 3));
				}
			}

			$this->miu_kuadat();
			$this->dd("\n<b>Miu^pembobotan $this->iterasi</b>");
			foreach ($this->miu_kuadat as $key => $val) {
				$this->dd("\n$key: ");
				foreach ($val as $k => $v) {
					$this->dd("\t" . round($v, 3));
				}
			}

			$this->miu_kuadat_x();
			foreach ($this->miu_kuadat_x as $key => $val) {
				$this->dd("\n<b>Miu^pembobotan $this->iterasi*$key</b>");
				foreach ($val as $k => $v) {
					$this->dd("\n$k: ");
					foreach ($v as $a => $b) {
						$this->dd("\t" . round($b, 3));
					}
				}
			}

			$this->pusat_cluster();
			$this->dd("\n<b>Pusat Cluster $this->iterasi</b>");
			foreach ($this->pusat_cluster as $key => $val) {
				$this->dd("\n$key: ");
				foreach ($val as $k => $v) {
					$this->dd("\t" . round($v, 3));
				}
			}

			$this->xv();
			$this->dd("\n<b>XV $this->iterasi</b>");
			foreach ($this->xv as $key => $val) {
				$this->dd("\n$key: ");
				foreach ($val as $k => $v) {
					$this->dd("\t" . round($v, 3));
				}
			}

			$this->nilai_l();
			$this->dd("\n<b>L $this->iterasi</b>");
			foreach ($this->nilai_l as $key => $val) {
				$this->dd("\n$key: ");
				foreach ($val as $k => $v) {
					$this->dd("\t" . round($v, 3));
				}
				$this->dd("\t:" . round(array_sum($val), 3));
			}

			$this->lt();
			$this->dd("\n<b>LT $this->iterasi</b>");
			foreach ($this->lt as $key => $val) {
				$this->dd("\n$key: ");
				foreach ($val as $k => $v) {
					$this->dd("\t" . round($v, 3));
				}
				$this->dd("\t:" . round(array_sum($val), 3));
			}

			$fo = $this->fungsi_objektif();
			$this->dd("\n<b>Fungsi Objektif $this->iterasi : " . $fo . "</b>");

			$this->dd("\n$fo - $this->fungsi_objektif");
			$selisih = abs($fo - $this->fungsi_objektif);
			$this->dd("\n<b>Selisih Fungsi Objektif $this->iterasi : " . $selisih . "</b>");

			if ($selisih > $this->epsilon) {
				if ($this->iterasi == $this->max_iterasi) {
					$this->dd("\n<b class='text-info'>Karena Iterasi ($this->iterasi) == Maksimal Iterasi ($this->max_iterasi), maka iterasi dihentikan.</b>");
					$success = true;
				} else {
					$this->dd("\n<b class='text-info'>Karena Selisih Fungsi Objektif ($selisih) > dari $this->epsilon, maka iterasi dilanjutkan.</b>");
					$this->fungsi_objektif = $fo;
					$this->anggota_baru();
				}
				$this->iterasi++;
			} else {
				$this->dd("\n<b class='text-info'>Karena Selisih Fungsi Objektif ($selisih) <= dari $this->epsilon, maka iterasi dihentikan.</b>");
				$success = true;
			}
		}
		$this->hasil();
	}
	function hasil()
	{
		foreach ($this->keanggotaan as $key => $val) {
			$maxs = array_keys($val, max($val));
			$this->hasil[$key] = $maxs[0];
		}
	}
	function anggota_baru()
	{
		foreach ($this->lt as $key => $val) {
			$total = array_sum($val);
			foreach ($val as $k => $v) {
				$this->keanggotaan[$key][$k] = $v / $total;
			}
		}
	}
	function fungsi_objektif()
	{
		$n = 0;
		foreach ($this->nilai_l as $key => $val) {
			$n += array_sum($val);
		}
		return $n;
	}
	function lt()
	{
		foreach ($this->xv as $key => $val) {
			foreach ($val as $k => $v) {
				$this->lt[$key][$k] = pow($v, -1 / ($this->pembobot - 1));
			}
		}
	}
	function nilai_l()
	{
		foreach ($this->xv as $key => $val) {
			foreach ($val as $k => $v) {
				$this->nilai_l[$key][$k] = $v * $this->miu_kuadat[$key][$k];
			}
		}
	}
	function xv()
	{
		$this->xv = array();
		foreach ($this->cluster as $key => $val) {
			foreach ($this->data as $k => $v) {
				foreach ($v as $a => $b) {
					$this->xv[$k][$key] += pow($b - $this->pusat_cluster[$key][$a], 2);
				}
			}
		}
	}
	function pusat_cluster()
	{
		$miu_kuadat_total = array();
		foreach ($this->miu_kuadat as $key => $val) {
			foreach ($val as $k => $v) {
				$miu_kuadat_total[$k] += $v;
			}
		}
		$miu_kuadat_x_total = array();
		foreach ($this->miu_kuadat_x as $key => $val) {
			foreach ($val as $k => $v) {
				foreach ($v as $a => $b) {
					$miu_kuadat_x_total[$key][$a] += $b;
				}
			}
		}
		foreach ($miu_kuadat_x_total as $key => $val) {
			foreach ($val as $k => $v) {
				$this->pusat_cluster[$key][$k] = $v / $miu_kuadat_total[$key];
			}
		}
	}
	function miu_kuadat_x()
	{
		foreach ($this->cluster as $key) {
			foreach ($this->data as $k => $v) {
				foreach ($v as $a => $b) {
					$this->miu_kuadat_x[$key][$k][$a] = $b * $this->miu_kuadat[$k][$key];
				}
			}
		}
	}
	function miu_kuadat()
	{
		foreach ($this->keanggotaan as $key => $val) {
			foreach ($val as $k => $v) {
				$this->miu_kuadat[$key][$k] = pow($v, $this->pembobot);
			}
		}
	}
	function random_cluster()
	{
		$arr = array();
		foreach ($this->data as $key => $val) {
			foreach ($this->cluster as $k) {
				$arr[$key][$k] = rand(1, 10);
			}
		}
		foreach ($arr as $key => $val) {
			$total = array_sum($val);
			foreach ($val as $k => $v) {
				$arr[$key][$k] = $v / $total;
			}
		}
		$this->random_cluster = $arr;
	}
	function dd($str)
	{
		if ($this->is_debug)
			echo $str;
	}
}
