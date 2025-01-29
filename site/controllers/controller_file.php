<?php

require_once 'models/model.php';

// وظيفة للحصول على جميع بيانات الملفات
function get_all_file_data($pdo) {
    return get_all('uploaded_files', $pdo);
}

// وظيفة للحصول على بيانات ملف محدد
function get_file_data($id, $pdo) {
    return get_by_id('uploaded_files', 'id_uploaded_files', $id, $pdo);
}

// وظيفة لإضافة بيانات ملف
function add_file_data($data, $pdo) {
    return insert('uploaded_files', $data, $pdo);
}

// وظيفة لتحديث بيانات ملف
function update_file_data($data, $id, $pdo) {
    return update('uploaded_files', 'id_uploaded_files', $data, $id, $pdo);
}

// وظيفة لحذف بيانات ملف
function delete_file_data($id, $pdo) {
    return delete('uploaded_files', 'id_uploaded_files', $id, $pdo);
}




// وظيفة للحصول على جميع بيانات الملفات
function get_all_file_fields($pdo) {
    return get_all('file_fields', $pdo);
}

// وظيفة للحصول على بيانات ملف محدد
function get_file_fields($id, $pdo) {
    return get_by_id('file_fields', 'id_file_fields', $id, $pdo);
}

// وظيفة لإضافة بيانات ملف
function add_file_fields($data, $pdo) {
    return insert('file_fields', $data, $pdo);
}

// وظيفة لتحديث بيانات ملف
function update_file_fields($data, $id, $pdo) {
    return update('file_fields', 'id_file_fields', $data, $id, $pdo);
}

// وظيفة لحذف بيانات ملف
function delete_file_fields($id, $pdo) {
    return delete('file_fields', 'id_file_fields', $id, $pdo);
}







?>



