use rootrack;

create table hashes(
	acc_id VARCHAR(20),
	image VARCHAR(700) not null unique,
	ahash VARCHAR(20),
    phash VARCHAR(20),
    dhash VARCHAR(20),
    whash VARCHAR(20),
    colorhash VARCHAR(20),
    timing VARCHAR(20));

select * from hashes;
