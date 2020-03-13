create table if not exists user
(
    id             int auto_increment
        primary key,
    name           varchar(60) not null,
    email          varchar(60) not null,
    territory      text        not null,
    territory_json json        not null,
    constraint email
        unique (email)
);
insert user(name, email, territory, territory_json)
value ('Petro',' example@gmail.com', 'territory', {"test":"test"});
