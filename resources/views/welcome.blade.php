<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lottery System</title>
    <!-- Bootstrap CSS -->
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Lottery System</h2>
        <button id="generateLottery" class="btn btn-primary mb-3">ดำเนินการสุ่มรางวัล</button>

        <table class="table table-striped table-bordered" id="lotteryTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">รางวัลที่ 1</th>
                    <th scope="col">รางวัลข้างเคียงรางวัลที่ 1</th>
                    <th scope="col">รางวัลที่ 2</th>
                    <th scope="col">รางวัลเลขท้าย 2 ตัว</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="prize1"></td>
                    <td id="adjacentPrize1">
                        <div id="adjacentPrize1_1" class="d-inline-block mr-2"></div>
                        <div id="adjacentPrize1_2" class="d-inline-block mr-2"></div>
                    </td>
                    <td>
                        <div id="prize2_1" class="d-inline-block mr-2"></div>
                        <div id="prize2_2" class="d-inline-block mr-2"></div>
                        <div id="prize2_3" class="d-inline-block mr-2"></div>
                    </td>
                    <td id="prizeLast2"></td>
                </tr>
            </tbody>
        </table>

        <div class="mb-3">
            <label for="lotteryNumber" class="form-label">กรอกตัวเลขเพื่อตรวจรางวัล</label>
            <input type="text" class="form-control" id="lotteryNumber">
        </div>
        <button id="checkPrize" class="btn btn-success">ตรวจรางวัล</button>
        <div id="resultMessage" class="mt-3"></div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script> --}}
    <script>
        document.getElementById('generateLottery').addEventListener('click', function() {
            // สุ่มรางวัลที่ 1
            let prize1 = Math.floor(Math.random() * 1000).toString().padStart(3, '0');

            // รางวัลเลขข้างเคียงรางวัลที่ 1
            let adjacentPrize1_1 = (parseInt(prize1) - 1).toString().padStart(3, '0');
            let adjacentPrize1_2 = (parseInt(prize1) + 1).toString().padStart(3, '0');

            // สุ่มรางวัลที่ 2 จำนวน 3 รางวัล
            let prize2_1 = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            //console.log(prize2_1);
            let prize2_2 = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            let prize2_3 = Math.floor(Math.random() * 1000).toString().padStart(3, '0');

            // สุ่มรางวัลเลขท้าย 2 ตัว
            let prizeLast2 = Math.floor(Math.random() * 100).toString().padStart(2, '0');

            // แสดงผลรางวัลในตาราง
            document.getElementById('prize1').textContent = prize1;
            document.getElementById('adjacentPrize1_1').textContent = adjacentPrize1_1;
            document.getElementById('adjacentPrize1_2').textContent = adjacentPrize1_2;
            document.getElementById('prize2_1').textContent = prize2_1;
            document.getElementById('prize2_2').textContent = prize2_2;
            document.getElementById('prize2_3').textContent = prize2_3;
            document.getElementById('prizeLast2').textContent = prizeLast2;
        });
        document.getElementById('checkPrize').addEventListener('click', function() {
            // รับค่าหมายเลขล็อตเตอรีที่ผู้ใช้กรอก
            let inputNumber = document.getElementById('lotteryNumber').value.trim();

            // สร้างข้อความผลลัพธ์เริ่มต้น
            let resultMessage = '';

            // เริ่มตรวจสอบรางวัล
            // ตรวจสอบหากหมายเลขที่ผู้ใช้กรอกตรงกับรางวัลที่ 1
            if (inputNumber === document.getElementById('prize1').textContent) {
                resultMessage += 'หมายเลข ' + inputNumber + ' ถูกรางวัลที่ 1<br>';
            }

            // ตรวจสอบหากหมายเลขที่ผู้ใช้กรอกตรงกับรางวัลข้างเคียงรางวัลที่ 1
            if (inputNumber === document.getElementById('adjacentPrize1_1').textContent || inputNumber === document
                .getElementById('adjacentPrize1_2').textContent) {
                resultMessage += 'หมายเลข ' + inputNumber + ' ถูกรางวัลข้างเคียงรางวัลที่ 1<br>';
            }

            // ตรวจสอบหากหมายเลขที่ผู้ใช้กรอกตรงกับรางวัลที่ 2
            if (inputNumber === document.getElementById('prize2_1').textContent || inputNumber === document
                .getElementById('prize2_2').textContent || inputNumber === document.getElementById('prize2_3')
                .textContent) {
                resultMessage += 'หมายเลข ' + inputNumber + ' ถูกรางวัลที่ 2<br>';
            }

            // ตรวจสอบหากหมายเลขที่ผู้ใช้กรอกตรงกับรางวัลเลขท้าย 2 ตัว
            if (inputNumber.substring(1) === document.getElementById('prizeLast2').textContent) {
                resultMessage += 'หมายเลข ' + inputNumber + ' ถูกรางวัลเลขท้าย 2 ตัว<br>';
            }

            // ถ้าหมายเลขที่ผู้ใช้กรอกไม่ตรงกับรางวัลใดเลย
            if (resultMessage === '') {
                resultMessage = 'หมายเลข ' + inputNumber + ' ไม่ถูกรางวัลใดเลย';
            }

            // แสดงข้อความผลลัพธ์
            document.getElementById('resultMessage').innerHTML = resultMessage;
        });
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>

</html>
