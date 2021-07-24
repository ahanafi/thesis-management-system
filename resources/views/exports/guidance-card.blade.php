<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Kartu Bimbingan Skripsi - {{ $student->getM }}</title>
</head>
<style>
*{
    padding:0;
    margin:0;
    text-decoration: none;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}
body{

}
#card{
    margin:50px;
}
#card-header{
    width: 100%;
    display: block;
}
.card-title{
    display: inline-block;
    border:3px solid #000 !important;
    padding:5px 7px;
    width: auto !important;
    font-style: italic;
    float: left;
}
.card-logo img{
    float: right;
    height: 120px;
}
table{
    width: 100%;
    border-collapse: collapse;
}
table tr th{
    font-weight: bold;
}
table tr td{
    padding:5px;
    border-collapse: collapse !important;
    vertical-align: top;
}
.dot-border-bottom{
    border-bottom: 2px dotted #000;
}
#card-identity{
    padding-top: 120px;
    margin-bottom: 30px;
}
#guidance{
    width: 100%;
}
.guidance-table{
    width: 100%;
}
.guidance-table tr th, .guidance-table tr td{
    padding:10px;
    border:1px solid #000;
    border-collapse: collapse;
}
.guidance-table tr td:nth-child(3){
    width: 65%;
}
.text-center{
    vertical-align: middle;
    text-align: center;
}
</style>
<body>
    <div id="card">
        <div id="card-header">
            <div class="card-logo">
                <img src="{{ public_path('media/photos/ucic.png') }}" alt="">
            </div>
            <h3 class="card-title">KARTU BIMBINGAN SKRIPSI / TA</h3>
        </div>
        <div id="card-identity">
            <table cellspacing="0" cellpadding="5">
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td class="dot-border-bottom">{{ $student->nim }}</td>
                </tr>
                <tr>
                    <td>NAMA MAHASISWA</td>
                    <td>:</td>
                    <td class="dot-border-bottom">{{ $student->getName() }}</td>
                </tr>
                <tr>
                    <td>PROGRAM STUDI</td>
                    <td>:</td>
                <td class="dot-border-bottom">{{ $student->study_program->getComplexName() }}</td>
                </tr>
                <tr>
                    <td>PEMBIMBING</td>
                    <td>:</td>
                    <td class="dot-border-bottom">{{ $lecturer->getNameWithDegree() }}</td>
                </tr>
                <tr>
                    <td>JUDUL SKRIPSI / TA</td>
                    <td>:</td>
                    <td class="dot-border-bottom">{{ $student->thesis->research_title }}</td>
                </tr>
            </table>
        </div>
        <div id="guidance">
            <table class="guidance-table">
                <thead>
                <tr>
                    <th>NO.</th>
                    <th>TANGGAL</th>
                    <th>MATERI</th>
                    <th>PARAF MAHASISWA</th>
                    <th>PARAF PEMBIMBING</th>
                </tr>
                </thead>
                <tbody>
                @foreach($guidance as $guide)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $guide->created_at->format('d/m/Y') }}</td>
                        <td>{{ strtoupper($guide->title) }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
                @for ($i = count($guidance) + 1; $i <= (10 - count($guidance) + 1); $i++)
                    <tr>
                        <td class="text-center">{{ $i }}</td>
                        <td class="text-center"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
