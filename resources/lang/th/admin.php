<?php

return [
    // General
    'dashboard' => 'แดชบอร์ด',
    'manage_fruits' => 'จัดการผลไม้',
    'manage_categories' => 'จัดการหมวดหมู่',
    'manage_quotes' => 'จัดการคำขอใบเสนอราคา',
    'quotes' => 'คำขอใบเสนอราคา',
    
    // Fruits
    'fruits' => 'ผลไม้',
    'fruit' => 'ผลไม้',
    'create_fruit' => 'สร้างผลไม้ใหม่',
    'edit_fruit' => 'แก้ไขผลไม้',
    'all_fruits' => 'ผลไม้ทั้งหมด',
    'fruit_details' => 'รายละเอียดผลไม้',
    'fruit_created' => 'สร้างผลไม้สำเร็จแล้ว',
    'fruit_updated' => 'อัปเดตผลไม้สำเร็จแล้ว',
    'fruit_deleted' => 'ลบผลไม้สำเร็จแล้ว',
    
    // Categories
    'categories' => 'หมวดหมู่',
    'category' => 'หมวดหมู่',
    'create_category' => 'สร้างหมวดหมู่ใหม่',
    'edit_category' => 'แก้ไขหมวดหมู่',
    'update_category' => 'อัปเดตหมวดหมู่',
    'parent_category' => 'หมวดหมู่หลัก',
    'no_parent' => 'ไม่มีหมวดหมู่หลัก (ระดับบนสุด)',
    'select_parent_category_help' => 'เลือกหมวดหมู่หลักหรือปล่อยว่างไว้สำหรับหมวดหมู่ระดับบนสุด',
    'category_cannot_be_own_parent' => 'หมวดหมู่ไม่สามารถเป็นหมวดหมู่หลักของตัวเองได้',
    'category_cannot_select_child_as_parent' => 'ไม่สามารถเลือกหมวดหมู่ย่อยเป็นหมวดหมู่หลักได้',
    'slug' => 'สลัก',
    'slug_help' => 'สลักจะถูกสร้างโดยอัตโนมัติจากชื่อ',
    'active' => 'เปิดใช้งาน',
    
    // Fruit attributes
    'name' => 'ชื่อ',
    'description' => 'คำอธิบาย',
    'origin' => 'แหล่งกำเนิด',
    'taste_profile' => 'โปรไฟล์รสชาติ',
    'seasonality' => 'ฤดูกาล',
    'price' => 'ราคา',
    'category' => 'หมวดหมู่',
    'image' => 'รูปภาพ',
    'is_available' => 'มีพร้อมจำหน่าย',
    'is_featured' => 'แนะนำ',
    'actions' => 'การดำเนินการ',
    'current_image' => 'รูปภาพปัจจุบัน',
    'new_image' => 'รูปภาพใหม่',
    
    // Languages
    'language' => 'ภาษา',
    'english' => 'อังกฤษ',
    'thai' => 'ไทย',
    'chinese' => 'จีน',
    'language_tabs' => 'แท็บภาษา',
    'english_content' => 'เนื้อหาภาษาอังกฤษ',
    'thai_content' => 'เนื้อหาภาษาไทย',
    'chinese_content' => 'เนื้อหาภาษาจีน',
    
    // Actions
    'create' => 'สร้าง',
    'edit' => 'แก้ไข',
    'update' => 'อัปเดต',
    'delete' => 'ลบ',
    'save' => 'บันทึก',
    'cancel' => 'ยกเลิก',
    'back' => 'กลับ',
    'confirm_delete' => 'คุณแน่ใจหรือไม่ว่าต้องการลบรายการนี้?',
    
    // Validation
    'required_field' => 'จำเป็นต้องกรอกช่องนี้',
    'invalid_image' => 'โปรดอัปโหลดรูปภาพที่ถูกต้อง',
    'image_too_large' => 'ขนาดรูปภาพไม่ควรเกิน 2MB',
    'please_fix_errors' => 'โปรดแก้ไขข้อผิดพลาดต่อไปนี้:',
    
    // Status
    'available' => 'มีพร้อมจำหน่าย',
    'featured' => 'แนะนำ',
    'yes' => 'ใช่',
    'no' => 'ไม่',
    'standard' => 'ทั่วไป',
    
    // Form helpers
    'select_category' => 'เลือกหมวดหมู่',
    'select_category_help' => 'เลือกหมวดหมู่สำหรับผลไม้นี้ หมวดหมู่หลักแสดงปกติ หมวดหมู่ย่อยจะถูกเยื้อง',
    'image_help' => 'ขนาดไฟล์สูงสุด: 2MB ขนาดที่แนะนำ: 800x600px',
    'cannot_delete_category_with_fruits' => 'ไม่สามารถลบหมวดหมู่ที่มีผลไม้ได้ โปรดลบผลไม้ก่อนหรือย้ายไปยังหมวดหมู่อื่น',
    'cannot_delete_category_with_children' => 'ไม่สามารถลบหมวดหมู่ที่มีหมวดหมู่ย่อยได้ โปรดลบหรือย้ายหมวดหมู่ย่อยก่อน',
    'category_deleted_successfully' => 'ลบหมวดหมู่สำเร็จแล้ว',
];
