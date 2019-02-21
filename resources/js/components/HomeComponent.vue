
<template>
<div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
            <router-link to="/home" class="nav-link">Home</router-link>
            </li>
            <li class="nav-item">
            <router-link to="/create" class="nav-link">Create Post</router-link>
            </li>
            <li class="nav-item">
            <router-link to="/posts" class="nav-link">Posts</router-link>
            </li>
        </ul>
    </nav>
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card card-default">
              <div class="card-header">Home</div>

							<!-- 
								Data Di Looping menggunakan v-for seperti dibawah 
								di dalam <highcharts> ada v-if untuk kondisional, jika isi series tidak kosong 
									maka chart akan ditampilkan, bila tidak maka <div v-else> yang di tampilkan
								
								v-for <--- untuk looping, contoh v-for="isi in dari_data" -> v-for="isi in tahu";
													 maka kita bisa dapet isi dari tahu seperti. isi.toge, isi.kacang, isi.sayur;
								:key digunakan untuk identitas, disitu menggunakan id_post agar beda key pada masing2 yang di looping;

								v-if <---- di sebutnya conditional Rendering, component bakal di tampilkan jika memenuhi kondisi
								v-else <---- component yang ditampilkan jika tidak memenuhi kondisi
							-->
              <div style="border-width: 1px" v-for="post in posts" :key="post.id" class="card-body">
								<div v-if="post.chartOptions.series.length > 1">
									<highcharts v-if="post.chartOptions.series.length > 1" :key="post.id" :options="post.chartOptions"/>
									<p style="margin-left: 32px">Articles: {{ post.articles }}</p>
								</div>
								<div v-else>
									<center>
									<h4>{{ post.name }} </h4>
									<h5>{{ post.description }} </h5>
									<br>
										Tidak Ada Charts
									<br>
									</center>
									<p style="margin-left: 32px">Articles: {{ post.articles }}</p>
								</div>
								<hr>
              </div>
          </div>
      </div>
  </div>
</div>
</template>

<script>
    export default {
			data() {
        return {
					posts: [],
        }
			},
			
      mounted() {
        let uri = 'http://127.0.0.1:8000/api/posts';
        this.axios.get(uri).then(response => {
					
					const data = response.data.data; // <-- Bikin variable baru dengan data yang di dapat dari API;

					// Fungsi Looping dalam javascript
					data.map(async post => {
						const obj = {key: '', name: '', description: '', articles: '', chartOptions: null}; // <--- Bikin Variable yang isinya object; {} <-- menunjukan bahwa variable itu berbentuk object;
					
						// Cara set data kedalam object yaitu dengan cara --> nama_variable.key_yang_mau_di_set
						// Contoh:
						// const siswa = {};
						// siswa.nis = 11223123;
						// siswa.nama = "Syukron";
						// siswa.kelas = "RPL XII-2";
						// maka bila di tampilkan data akan menjadi
						// { nis: 11223123, nama: "Syukron", kelas: "RPL XII-2" }

						obj.key = post.id_data; // <--- Set object key di ambil dari id_data posts;
						obj.name= post.title; // <--- Set object name di ambil dari name posts;
						obj.description = post.description; // <--- Set object description di ambil dari description posts;
						obj.articles = post.articles; // <--- Set object articles di ambil dari articles posts;
					

						const options = {
							// Tipe Chart nya, bisa diliat di Highcharts.com
							chart: {
									type: 'column' 
							},
							// Judul Chart nya
							title: {
								text: obj.name
							},
							// Sub Judul Chart nya
							subtitle: {
								text: obj.description
							},
							// Ini Emang bentukan nya gini, aku ge gk ngerti gimana wkwkwk;
							tooltip: {
								headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
								pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
										'<td style="padding:0"><b>{point.y:.1f} L</b></td></tr>',
								footerFormat: '</table>',
								shared: true,
								useHTML: true
							},
							// ini juga sama ehehhehe
							plotOptions: {
								column: {
										pointPadding: 0.2,
										borderWidth: 0
								}
							},
							//nah ini xAxis untuk data yang horizontal, disini tanggal;
							xAxis: {
									categories: [],
									crosshair: true
							},
							//ini yAxis untuk data yang vertical , tapi untuk sementera gk dipake, karena default nya kosong;
							yAxis: {
									categories: []
							},
							series: [],
						} // <--- Set default options;

						obj["chartOptions"] = options;
						
						const xAxis = {categories: []}; // Variable Object dengan default categories array untuk setting chart x;
						const yAxis = {categories: []}; // Variable Object dengan default categories array untuk setting chart y;
						const series = []; // Bikin Variable Series dalam bentuk array. [] <-- menunjukan bahwa variable itu berbentuk array;
						
						
						const json = JSON.parse(post.data_saved); // <-- Parsing JSON dari bentuk String dari data_saved posts;
						// console.log(json); // Ini hanya untuk menampilkan data di console.
						
						if (json !== null && json.length > 0) {
							const data1 = {name: json[0].y1 /* ambil data dari json data pertama karena judul data */, data: []}; // set Variable data 1 -> RON95
							const data2 = {name: json[0].y2, data: []}; // set Variable data 2 -> RON97
							const data3 = {name: json[0].y3, data: []}; // set Variable data 3 -> Diesel
						

						json.map((isi, index) => {
							if (index === 0) {
							}else{
								xAxis.categories.push(this.moment(isi.x).format('DD MMM YY'));
								data1.data.push(Number(isi.y1)); // Masukan Data Angka ke RON95
								data2.data.push(Number(isi.y2)); // Masukan Data Angka ke RON97
								data3.data.push(Number(isi.y3)); // Masukan DATA ANGKA ke Diesel
							}
						});
							series.push(data1); // Masukan Data RON95 Kedalam Series Untuk Ditampilkan di chart
							series.push(data2); // Masukan Data RON97 Kedalam Series Untuk Ditampilkan di chart
							series.push(data3); // Masukan Data Diesel Kedalam Series Untuk Ditampilkan di chart
						
						}

						options.xAxis = xAxis; // Set xAxis untuk Charts dengan data yang di dapat dari json;
						options.yAxis = yAxis; // Set yAxis untuk Charts dengan data yang di dapat dari json;
						options.series = series;

						// console.log({xAxis});
						// console.log({yAxis});
						
						obj["chartOptions"] = options;

						this.posts.push(obj); // <------ Masukan Object yang sudah di set tadi ke dalam array;
					})
					// End Looping
        }).catch(error => console.log({error}));
			},
    }
</script>