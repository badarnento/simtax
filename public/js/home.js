    console.log("initHomePage() dipanggil!");

    url = "/api/users/list";
    jsonData = [
        { "data": "no", "width":"10px", "class":"text-center"},
        { "data": "name", "width":"200px", "class":"text-left"},
        { "data": "email", "width":"100px"},
        { "data": "created_at", "width":"100px", "class":"text-center"}
    ];
    data_table(url, jsonData);
