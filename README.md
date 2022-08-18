Pentru a crea un user admin , creeaza un user normal si schimba
proprietatea is_admin = 1 in db




Am incercat sa pun seeder pt fiecare (appointment,user,consultant) , ceva nu merge , nu stiu de ce.De pe contul de admin se pot crea consultanti si de restul programari cu consultanti .

Pe pagina de admin se pot gestiona tot de ce inseamna edit / delete (user + programari) si create/edit/delete la consultanti . Odata ce este sters un consultant , nu se sterg si programarile asociate cu el(lipsa relatii de cascade). 

Relatia de on delete cascade nu a mers(am vb cu un reprezentant de la dvs. despre asta si mi-a comunicat sa las comentariu aici)
