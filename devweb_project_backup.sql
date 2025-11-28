--
-- PostgreSQL database dump
--

\restrict R0RXKM2vVWm7Abdf5mD9DlV0e3s08QaS2MDDHhFgl61wxO2UlLq3aE0fzAvFgd6

-- Dumped from database version 18.1
-- Dumped by pg_dump version 18.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: app; Type: SCHEMA; Schema: -; Owner: devweb_project
--

CREATE SCHEMA app;


ALTER SCHEMA app OWNER TO devweb_project;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: musics; Type: TABLE; Schema: app; Owner: devweb_project
--

CREATE TABLE app.musics (
    id integer NOT NULL,
    playlist_id integer NOT NULL,
    link text NOT NULL,
    added_at timestamp without time zone DEFAULT now()
);


ALTER TABLE app.musics OWNER TO devweb_project;

--
-- Name: musics_id_seq; Type: SEQUENCE; Schema: app; Owner: devweb_project
--

CREATE SEQUENCE app.musics_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE app.musics_id_seq OWNER TO devweb_project;

--
-- Name: musics_id_seq; Type: SEQUENCE OWNED BY; Schema: app; Owner: devweb_project
--

ALTER SEQUENCE app.musics_id_seq OWNED BY app.musics.id;


--
-- Name: playlists; Type: TABLE; Schema: app; Owner: devweb_project
--

CREATE TABLE app.playlists (
    id integer NOT NULL,
    user_id uuid,
    name character varying(255) NOT NULL,
    description text,
    cover_image character varying(500),
    number_of_musics integer DEFAULT 0 NOT NULL,
    likes integer DEFAULT 0 NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE app.playlists OWNER TO devweb_project;

--
-- Name: playlists_id_seq; Type: SEQUENCE; Schema: app; Owner: devweb_project
--

CREATE SEQUENCE app.playlists_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE app.playlists_id_seq OWNER TO devweb_project;

--
-- Name: playlists_id_seq; Type: SEQUENCE OWNED BY; Schema: app; Owner: devweb_project
--

ALTER SEQUENCE app.playlists_id_seq OWNED BY app.playlists.id;


--
-- Name: users; Type: TABLE; Schema: app; Owner: devweb_project
--

CREATE TABLE app.users (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    email character varying(155) NOT NULL,
    password_hash text NOT NULL,
    name character varying(155) NOT NULL
);


ALTER TABLE app.users OWNER TO devweb_project;

--
-- Name: musics id; Type: DEFAULT; Schema: app; Owner: devweb_project
--

ALTER TABLE ONLY app.musics ALTER COLUMN id SET DEFAULT nextval('app.musics_id_seq'::regclass);


--
-- Name: playlists id; Type: DEFAULT; Schema: app; Owner: devweb_project
--

ALTER TABLE ONLY app.playlists ALTER COLUMN id SET DEFAULT nextval('app.playlists_id_seq'::regclass);


--
-- Data for Name: musics; Type: TABLE DATA; Schema: app; Owner: devweb_project
--

COPY app.musics (id, playlist_id, link, added_at) FROM stdin;
2	6	https://open.spotify.com/track/6dMcPn7MVrBN5YMBjRLal8?si=86cd65b7b44a42c8	2025-11-26 18:47:33.579805
3	6	https://open.spotify.com/track/0iD94fatV4gLMmOQhNTQx6?si=8e9b1f83f60c4f5c	2025-11-26 19:08:49.126688
4	6	https://open.spotify.com/track/5qZKuuKGngifO5psg19XdO?si=a347c8d4c4aa4fcc	2025-11-26 19:09:03.046155
5	6	https://open.spotify.com/track/6ey8HhYmR57lhESTf15RcF?si=a0f665e4291f4998	2025-11-26 19:28:25.142201
\.


--
-- Data for Name: playlists; Type: TABLE DATA; Schema: app; Owner: devweb_project
--

COPY app.playlists (id, user_id, name, description, cover_image, number_of_musics, likes, created_at, updated_at) FROM stdin;
4	6b86a7fb-2edc-4052-8aa2-8a3d562edf1b	teste 2	uma descrição	/_static/uploads/692521236b930_Paleta.png	0	0	2025-11-25 00:23:15.441168	2025-11-25 00:23:15.441168
6	6b86a7fb-2edc-4052-8aa2-8a3d562edf1b	Música	Playlist com as melhores músicas\r\n\r\n	/_static/uploads/69252a98c632f_andrea-sonda-ihDDSaHXvEc-unsplash.jpg	0	0	2025-11-25 01:03:36.81243	2025-11-25 01:03:36.81243
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: app; Owner: devweb_project
--

COPY app.users (id, email, password_hash, name) FROM stdin;
6b86a7fb-2edc-4052-8aa2-8a3d562edf1b	kauai@gmail.com	$2y$12$9MOhaQ0ulQL/4ibnqmAcYeGW8kXPLbwOG8zWsc2hVYpW60K/YltsG	Kauai Tavora
164c3e78-19c8-4f8c-93f1-df2c4c1614e0	joao@gmail.com	$2y$12$i0s7EvFizb4BSyutbAH0KeVun9NUM9RRJo46F3gAKjXd3gy.hVIWm	joao
d62388e9-ee98-4fb3-8b88-ee3760c83f5c	sono@gmail.com	$2y$12$xzhJeJZLvXx4Gf1vGFo3hupEKcZ4fvM8KAM1H08mHxhtq3/aG1m26	sonomaka
\.


--
-- Name: musics_id_seq; Type: SEQUENCE SET; Schema: app; Owner: devweb_project
--

SELECT pg_catalog.setval('app.musics_id_seq', 5, true);


--
-- Name: playlists_id_seq; Type: SEQUENCE SET; Schema: app; Owner: devweb_project
--

SELECT pg_catalog.setval('app.playlists_id_seq', 8, true);


--
-- Name: musics musics_pkey; Type: CONSTRAINT; Schema: app; Owner: devweb_project
--

ALTER TABLE ONLY app.musics
    ADD CONSTRAINT musics_pkey PRIMARY KEY (id);


--
-- Name: playlists playlists_pkey; Type: CONSTRAINT; Schema: app; Owner: devweb_project
--

ALTER TABLE ONLY app.playlists
    ADD CONSTRAINT playlists_pkey PRIMARY KEY (id);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: app; Owner: devweb_project
--

ALTER TABLE ONLY app.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: app; Owner: devweb_project
--

ALTER TABLE ONLY app.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: musics musics_playlist_id_fkey; Type: FK CONSTRAINT; Schema: app; Owner: devweb_project
--

ALTER TABLE ONLY app.musics
    ADD CONSTRAINT musics_playlist_id_fkey FOREIGN KEY (playlist_id) REFERENCES app.playlists(id) ON DELETE CASCADE;


--
-- Name: playlists playlists_user_id_fkey; Type: FK CONSTRAINT; Schema: app; Owner: devweb_project
--

ALTER TABLE ONLY app.playlists
    ADD CONSTRAINT playlists_user_id_fkey FOREIGN KEY (user_id) REFERENCES app.users(id) ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--

\unrestrict R0RXKM2vVWm7Abdf5mD9DlV0e3s08QaS2MDDHhFgl61wxO2UlLq3aE0fzAvFgd6

