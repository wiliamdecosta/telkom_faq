--
-- EnterpriseDB database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: edb_dblink_libpq; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS edb_dblink_libpq WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION edb_dblink_libpq; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION edb_dblink_libpq IS 'EnterpriseDB Foreign Data Wrapper for PostgreSQL';


--
-- Name: edb_dblink_oci; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS edb_dblink_oci WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION edb_dblink_oci; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION edb_dblink_oci IS 'EnterpriseDB Foreign Data Wrapper for Oracle';


--
-- Name: edbspl; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS edbspl WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION edbspl; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION edbspl IS 'EDB-SPL procedural language';


--
-- Name: pldbgapi; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pldbgapi WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION pldbgapi; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pldbgapi IS 'server-side support for debugging PL/pgSQL functions';


SET search_path = public, pg_catalog, sys, dbo;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: cip_agama; Type: TABLE; Schema: public; Owner: sikp; Tablespace: 
--

CREATE TABLE cip_agama (
    agama_id integer NOT NULL,
    agama_nama character varying(35)
);


ALTER TABLE public.cip_agama OWNER TO sikp;

--
-- Name: cip_agama_agama_id_seq; Type: SEQUENCE; Schema: public; Owner: sikp
--

CREATE SEQUENCE cip_agama_agama_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cip_agama_agama_id_seq OWNER TO sikp;

--
-- Name: cip_agama_agama_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sikp
--

ALTER SEQUENCE cip_agama_agama_id_seq OWNED BY cip_agama.agama_id;


--
-- Name: cip_pegawai; Type: TABLE; Schema: public; Owner: sikp; Tablespace: 
--

CREATE TABLE cip_pegawai (
    peg_id integer NOT NULL,
    agama_id integer,
    peg_nik character varying(15),
    peg_nama character varying(50),
    peg_tgl_lahir timestamp without time zone NOT NULL,
    peg_alamat text NOT NULL
);


ALTER TABLE public.cip_pegawai OWNER TO sikp;

--
-- Name: cip_pegawai_peg_id_seq; Type: SEQUENCE; Schema: public; Owner: sikp
--

CREATE SEQUENCE cip_pegawai_peg_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cip_pegawai_peg_id_seq OWNER TO sikp;

--
-- Name: cip_pegawai_peg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sikp
--

ALTER SEQUENCE cip_pegawai_peg_id_seq OWNED BY cip_pegawai.peg_id;


--
-- Name: core_menu; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE core_menu (
    menu_id integer NOT NULL,
    menu_pid integer,
    menu_code character varying(255),
    menu_file_name character varying(255),
    menu_listing_no numeric(2,0),
    menu_is_active character varying(1),
    menu_description character varying(255),
    menu_creation_date timestamp without time zone,
    menu_creation_by character varying(16),
    menu_updated_date timestamp without time zone,
    menu_updated_by character varying(16),
    menu_level integer,
    menu_path character varying(25)
);


ALTER TABLE public.core_menu OWNER TO telkom;

--
-- Name: TABLE core_menu; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE core_menu IS 'Daftar Menu';


--
-- Name: COLUMN core_menu.menu_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_id IS 'ID Menu';


--
-- Name: COLUMN core_menu.menu_pid; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_pid IS 'PID Menu';


--
-- Name: COLUMN core_menu.menu_code; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_code IS 'Kode Menu';


--
-- Name: COLUMN core_menu.menu_file_name; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_file_name IS 'Nama Module';


--
-- Name: COLUMN core_menu.menu_listing_no; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_listing_no IS 'No List';


--
-- Name: COLUMN core_menu.menu_is_active; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_is_active IS 'Is Active';


--
-- Name: COLUMN core_menu.menu_description; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_description IS 'Description';


--
-- Name: COLUMN core_menu.menu_creation_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_creation_date IS 'Tgl Pembuatan';


--
-- Name: COLUMN core_menu.menu_creation_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_creation_by IS 'Dibuat Oleh';


--
-- Name: COLUMN core_menu.menu_updated_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_updated_date IS 'Tgl Update';


--
-- Name: COLUMN core_menu.menu_updated_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_updated_by IS 'Diupdate Oleh';


--
-- Name: COLUMN core_menu.menu_level; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_menu.menu_level IS 'Level Depth';


--
-- Name: core_menu_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE core_menu_menu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.core_menu_menu_id_seq OWNER TO telkom;

--
-- Name: core_menu_menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE core_menu_menu_id_seq OWNED BY core_menu.menu_id;


--
-- Name: core_permission; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE core_permission (
    permission_id integer NOT NULL,
    permission_name character varying(255) NOT NULL,
    permission_desc character varying(255),
    permission_module character varying(255) NOT NULL
);


ALTER TABLE public.core_permission OWNER TO telkom;

--
-- Name: TABLE core_permission; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE core_permission IS 'Register Hak Akses';


--
-- Name: COLUMN core_permission.permission_name; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_permission.permission_name IS 'Nama Hak Akses';


--
-- Name: COLUMN core_permission.permission_desc; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_permission.permission_desc IS 'Keterangan';


--
-- Name: COLUMN core_permission.permission_module; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_permission.permission_module IS 'Modul';


--
-- Name: core_permission_permission_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE core_permission_permission_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.core_permission_permission_id_seq OWNER TO telkom;

--
-- Name: core_permission_permission_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE core_permission_permission_id_seq OWNED BY core_permission.permission_id;


--
-- Name: core_role; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE core_role (
    role_id integer NOT NULL,
    role_name character varying(255) NOT NULL,
    role_status character(1)
);


ALTER TABLE public.core_role OWNER TO telkom;

--
-- Name: TABLE core_role; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE core_role IS 'Grup/Peran Pengguna';


--
-- Name: COLUMN core_role.role_name; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_role.role_name IS 'Nama Grup';


--
-- Name: COLUMN core_role.role_status; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_role.role_status IS 'Status';


--
-- Name: core_role_menu; Type: TABLE; Schema: public; Owner: sikp; Tablespace: 
--

CREATE TABLE core_role_menu (
    rolemenu_id integer NOT NULL,
    role_id integer NOT NULL,
    menu_id integer NOT NULL,
    rolemenu_status character varying(1),
    rolemenu_creation_date timestamp without time zone,
    rolemenu_creation_by character varying(16),
    rolemenu_updated_date timestamp without time zone,
    rolemenu_updated_by character varying(16)
);


ALTER TABLE public.core_role_menu OWNER TO sikp;

--
-- Name: core_role_menu_rolemenu_id_seq; Type: SEQUENCE; Schema: public; Owner: sikp
--

CREATE SEQUENCE core_role_menu_rolemenu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.core_role_menu_rolemenu_id_seq OWNER TO sikp;

--
-- Name: core_role_menu_rolemenu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sikp
--

ALTER SEQUENCE core_role_menu_rolemenu_id_seq OWNED BY core_role_menu.rolemenu_id;


--
-- Name: core_role_permission; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE core_role_permission (
    role_id integer NOT NULL,
    permission_id integer NOT NULL,
    permission_level smallint DEFAULT 0 NOT NULL
);


ALTER TABLE public.core_role_permission OWNER TO telkom;

--
-- Name: TABLE core_role_permission; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE core_role_permission IS 'Hak Akses Grup';


--
-- Name: COLUMN core_role_permission.role_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_role_permission.role_id IS 'Grup';


--
-- Name: COLUMN core_role_permission.permission_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_role_permission.permission_id IS 'Hak Akses';


--
-- Name: COLUMN core_role_permission.permission_level; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_role_permission.permission_level IS 'Level Akses';


--
-- Name: core_role_role_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE core_role_role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.core_role_role_id_seq OWNER TO telkom;

--
-- Name: core_role_role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE core_role_role_id_seq OWNED BY core_role.role_id;


--
-- Name: core_sessions; Type: TABLE; Schema: public; Owner: sikp; Tablespace: 
--

CREATE TABLE core_sessions (
    session_id character varying(40) DEFAULT '0'::character varying NOT NULL,
    ip_address character varying(45) DEFAULT '0'::character varying NOT NULL,
    user_agent character varying(120) NOT NULL,
    last_activity bigint DEFAULT 0 NOT NULL,
    user_data text NOT NULL
);


ALTER TABLE public.core_sessions OWNER TO sikp;

--
-- Name: core_user; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE core_user (
    user_id integer NOT NULL,
    user_name character varying(255) NOT NULL,
    user_password character varying(255) NOT NULL,
    user_email character varying(255),
    user_realname character varying(255),
    user_status character(1)
);


ALTER TABLE public.core_user OWNER TO telkom;

--
-- Name: TABLE core_user; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE core_user IS 'Users';


--
-- Name: COLUMN core_user.user_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user.user_id IS 'ID User';


--
-- Name: COLUMN core_user.user_name; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user.user_name IS 'Nama User';


--
-- Name: COLUMN core_user.user_password; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user.user_password IS 'Password';


--
-- Name: COLUMN core_user.user_email; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user.user_email IS 'Email';


--
-- Name: COLUMN core_user.user_realname; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user.user_realname IS 'Nama Lengkap';


--
-- Name: COLUMN core_user.user_status; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user.user_status IS 'Status';


--
-- Name: core_user_permission; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE core_user_permission (
    user_id integer NOT NULL,
    permission_id integer NOT NULL,
    permission_level smallint DEFAULT 0 NOT NULL
);


ALTER TABLE public.core_user_permission OWNER TO telkom;

--
-- Name: TABLE core_user_permission; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE core_user_permission IS 'Hak Akses User';


--
-- Name: COLUMN core_user_permission.user_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user_permission.user_id IS 'User';


--
-- Name: COLUMN core_user_permission.permission_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user_permission.permission_id IS 'Hak Akses';


--
-- Name: COLUMN core_user_permission.permission_level; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user_permission.permission_level IS 'Level Akses';


--
-- Name: core_user_role; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE core_user_role (
    user_id integer NOT NULL,
    role_id integer NOT NULL,
    main_role smallint DEFAULT 0 NOT NULL
);


ALTER TABLE public.core_user_role OWNER TO telkom;

--
-- Name: TABLE core_user_role; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE core_user_role IS 'Grup User';


--
-- Name: COLUMN core_user_role.user_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user_role.user_id IS 'User';


--
-- Name: COLUMN core_user_role.role_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user_role.role_id IS 'Grup';


--
-- Name: COLUMN core_user_role.main_role; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_user_role.main_role IS 'Grup Utama';


--
-- Name: core_user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE core_user_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.core_user_user_id_seq OWNER TO telkom;

--
-- Name: core_user_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE core_user_user_id_seq OWNED BY core_user.user_id;


--
-- Name: core_variables; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE core_variables (
    var_id integer NOT NULL,
    var_component character varying(64) NOT NULL,
    var_name character varying(64) NOT NULL,
    var_value text,
    var_type character(1)
);


ALTER TABLE public.core_variables OWNER TO telkom;

--
-- Name: TABLE core_variables; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE core_variables IS 'System Variables';


--
-- Name: COLUMN core_variables.var_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_variables.var_id IS 'ID Var';


--
-- Name: COLUMN core_variables.var_component; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_variables.var_component IS 'Component';


--
-- Name: COLUMN core_variables.var_name; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_variables.var_name IS 'Nama Var';


--
-- Name: COLUMN core_variables.var_value; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_variables.var_value IS 'Nilai Var';


--
-- Name: COLUMN core_variables.var_type; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN core_variables.var_type IS 'Tipe Var';


--
-- Name: core_variables_var_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE core_variables_var_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.core_variables_var_id_seq OWNER TO telkom;

--
-- Name: core_variables_var_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE core_variables_var_id_seq OWNED BY core_variables.var_id;


--
-- Name: track_application; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE track_application (
    app_id integer NOT NULL,
    app_name character varying(50) NOT NULL,
    app_created_date timestamp without time zone,
    app_created_by character varying(16),
    app_updated_date timestamp without time zone,
    app_updated_by character varying(16)
);


ALTER TABLE public.track_application OWNER TO telkom;

--
-- Name: TABLE track_application; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE track_application IS 'Application';


--
-- Name: COLUMN track_application.app_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_application.app_id IS 'ID Application';


--
-- Name: COLUMN track_application.app_name; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_application.app_name IS 'Nama Aplikasi';


--
-- Name: COLUMN track_application.app_created_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_application.app_created_date IS 'Tgl Pembuatan';


--
-- Name: COLUMN track_application.app_created_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_application.app_created_by IS 'Dibuat Oleh';


--
-- Name: COLUMN track_application.app_updated_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_application.app_updated_date IS 'Tgl Update';


--
-- Name: COLUMN track_application.app_updated_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_application.app_updated_by IS 'Diupdate Oleh';


--
-- Name: track_application_app_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE track_application_app_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.track_application_app_id_seq OWNER TO telkom;

--
-- Name: track_application_app_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE track_application_app_id_seq OWNED BY track_application.app_id;


--
-- Name: track_evidence; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE track_evidence (
    evd_id integer NOT NULL,
    req_id integer,
    evd_file character varying(100),
    evd_desc text,
    evd_created_date timestamp without time zone,
    evd_created_by character varying(16),
    evd_updated_date timestamp without time zone,
    evd_updated_by character varying(16)
);


ALTER TABLE public.track_evidence OWNER TO telkom;

--
-- Name: TABLE track_evidence; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE track_evidence IS 'Detail Evidences';


--
-- Name: COLUMN track_evidence.evd_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_evidence.evd_id IS 'ID Evidence';


--
-- Name: COLUMN track_evidence.req_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_evidence.req_id IS 'ID Requirement';


--
-- Name: COLUMN track_evidence.evd_file; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_evidence.evd_file IS 'File';


--
-- Name: COLUMN track_evidence.evd_desc; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_evidence.evd_desc IS 'Deskripsi';


--
-- Name: COLUMN track_evidence.evd_created_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_evidence.evd_created_date IS 'Tgl Pembuatan';


--
-- Name: COLUMN track_evidence.evd_created_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_evidence.evd_created_by IS 'Dibuat Oleh';


--
-- Name: COLUMN track_evidence.evd_updated_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_evidence.evd_updated_date IS 'Tgl Update';


--
-- Name: COLUMN track_evidence.evd_updated_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_evidence.evd_updated_by IS 'Diupdate Oleh';


--
-- Name: track_evidence_evd_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE track_evidence_evd_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.track_evidence_evd_id_seq OWNER TO telkom;

--
-- Name: track_evidence_evd_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE track_evidence_evd_id_seq OWNED BY track_evidence.evd_id;


--
-- Name: track_faq; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE track_faq (
    faq_id integer NOT NULL,
    app_id integer,
    faq_case_name character varying(100) NOT NULL,
    faq_case_by character varying(50),
    faq_case_date timestamp without time zone,
    faq_solution text,
    faq_solution_by character varying(50),
    faq_solution_finish_date timestamp without time zone,
    faq_description text,
    faq_created_date timestamp without time zone,
    faq_created_by character varying(16),
    faq_updated_date timestamp without time zone,
    faq_updated_by character varying(16)
);


ALTER TABLE public.track_faq OWNER TO telkom;

--
-- Name: TABLE track_faq; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE track_faq IS 'FAQ';


--
-- Name: COLUMN track_faq.faq_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_id IS 'ID FAQ';


--
-- Name: COLUMN track_faq.app_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.app_id IS 'ID Application';


--
-- Name: COLUMN track_faq.faq_case_name; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_case_name IS 'Nama Kasus';


--
-- Name: COLUMN track_faq.faq_case_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_case_by IS 'Case By';


--
-- Name: COLUMN track_faq.faq_case_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_case_date IS 'Tgl Kasus';


--
-- Name: COLUMN track_faq.faq_solution; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_solution IS 'Solusi';


--
-- Name: COLUMN track_faq.faq_solution_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_solution_by IS 'Pembuat Solusi';


--
-- Name: COLUMN track_faq.faq_solution_finish_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_solution_finish_date IS 'Tgl Selesai';


--
-- Name: COLUMN track_faq.faq_description; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_description IS 'Keterangan';


--
-- Name: COLUMN track_faq.faq_created_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_created_date IS 'Tgl Pembuatan';


--
-- Name: COLUMN track_faq.faq_created_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_created_by IS 'Dibuat Oleh';


--
-- Name: COLUMN track_faq.faq_updated_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_updated_date IS 'Tgl Update';


--
-- Name: COLUMN track_faq.faq_updated_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq.faq_updated_by IS 'Diupdate Oleh';


--
-- Name: track_faq_attachment; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE track_faq_attachment (
    faq_attach_id integer NOT NULL,
    faq_id integer,
    faq_attach_file character varying(100),
    faq_attach_desc text,
    faq_attach_created_date timestamp without time zone,
    faq_attach_created_by character varying(16),
    faq_attach_updated_date timestamp without time zone,
    faq_attach_updated_by character varying(16)
);


ALTER TABLE public.track_faq_attachment OWNER TO telkom;

--
-- Name: TABLE track_faq_attachment; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE track_faq_attachment IS 'FAQ Attachments';


--
-- Name: COLUMN track_faq_attachment.faq_attach_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq_attachment.faq_attach_id IS 'ID Attachment';


--
-- Name: COLUMN track_faq_attachment.faq_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq_attachment.faq_id IS 'ID FAQ';


--
-- Name: COLUMN track_faq_attachment.faq_attach_file; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq_attachment.faq_attach_file IS 'Nama File';


--
-- Name: COLUMN track_faq_attachment.faq_attach_desc; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq_attachment.faq_attach_desc IS 'Keterangan';


--
-- Name: COLUMN track_faq_attachment.faq_attach_created_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq_attachment.faq_attach_created_date IS 'Tgl Pembuatan';


--
-- Name: COLUMN track_faq_attachment.faq_attach_created_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq_attachment.faq_attach_created_by IS 'Dibuat Oleh';


--
-- Name: COLUMN track_faq_attachment.faq_attach_updated_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq_attachment.faq_attach_updated_date IS 'Tgl Update';


--
-- Name: COLUMN track_faq_attachment.faq_attach_updated_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_faq_attachment.faq_attach_updated_by IS 'Diupdate Oleh';


--
-- Name: track_faq_attachment_faq_attach_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE track_faq_attachment_faq_attach_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.track_faq_attachment_faq_attach_id_seq OWNER TO telkom;

--
-- Name: track_faq_attachment_faq_attach_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE track_faq_attachment_faq_attach_id_seq OWNED BY track_faq_attachment.faq_attach_id;


--
-- Name: track_faq_faq_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE track_faq_faq_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.track_faq_faq_id_seq OWNER TO telkom;

--
-- Name: track_faq_faq_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE track_faq_faq_id_seq OWNED BY track_faq.faq_id;


--
-- Name: track_maintenance; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE track_maintenance (
    mnt_id integer NOT NULL,
    app_id integer,
    mnt_desc text,
    mnt_by character varying(50),
    mnt_date timestamp without time zone,
    mnt_evidence_desc text,
    mnt_created_date timestamp without time zone,
    mnt_created_by character varying(16),
    mnt_updated_date timestamp without time zone,
    mnt_updated_by character varying(16)
);


ALTER TABLE public.track_maintenance OWNER TO telkom;

--
-- Name: TABLE track_maintenance; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE track_maintenance IS 'Maintenance';


--
-- Name: COLUMN track_maintenance.mnt_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance.mnt_id IS 'ID Maintenance';


--
-- Name: COLUMN track_maintenance.app_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance.app_id IS 'ID Application';


--
-- Name: COLUMN track_maintenance.mnt_desc; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance.mnt_desc IS 'Deskripsi Maintenance';


--
-- Name: COLUMN track_maintenance.mnt_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance.mnt_by IS 'Maintenance Oleh';


--
-- Name: COLUMN track_maintenance.mnt_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance.mnt_date IS 'Tgl Maintenance';


--
-- Name: COLUMN track_maintenance.mnt_evidence_desc; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance.mnt_evidence_desc IS 'Deskripsi Evidence';


--
-- Name: COLUMN track_maintenance.mnt_created_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance.mnt_created_date IS 'Tgl Pembuatan';


--
-- Name: COLUMN track_maintenance.mnt_created_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance.mnt_created_by IS 'Dibuat Oleh';


--
-- Name: COLUMN track_maintenance.mnt_updated_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance.mnt_updated_date IS 'Tgl Update';


--
-- Name: COLUMN track_maintenance.mnt_updated_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance.mnt_updated_by IS 'Diupdate Oleh';


--
-- Name: track_maintenance_detail; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE track_maintenance_detail (
    mnt_det_id integer NOT NULL,
    mnt_id integer,
    mnt_det_pic character varying(50) NOT NULL,
    mnt_det_desc text,
    mnt_det_start_date timestamp without time zone,
    mnt_det_due_date timestamp without time zone,
    mnt_det_status character varying(1),
    mnt_det_created_date timestamp without time zone,
    mnt_det_created_by character varying(16),
    mnt_det_updated_date timestamp without time zone,
    mnt_det_updated_by character varying(16)
);


ALTER TABLE public.track_maintenance_detail OWNER TO telkom;

--
-- Name: TABLE track_maintenance_detail; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE track_maintenance_detail IS 'Detail Maintenance';


--
-- Name: COLUMN track_maintenance_detail.mnt_det_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_det_id IS 'ID Maintenance Detail';


--
-- Name: COLUMN track_maintenance_detail.mnt_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_id IS 'ID Maintenance';


--
-- Name: COLUMN track_maintenance_detail.mnt_det_pic; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_det_pic IS 'PIC';


--
-- Name: COLUMN track_maintenance_detail.mnt_det_desc; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_det_desc IS 'Deskripsi';


--
-- Name: COLUMN track_maintenance_detail.mnt_det_start_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_det_start_date IS 'Start Date';


--
-- Name: COLUMN track_maintenance_detail.mnt_det_due_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_det_due_date IS 'Due Date';


--
-- Name: COLUMN track_maintenance_detail.mnt_det_status; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_det_status IS 'Status';


--
-- Name: COLUMN track_maintenance_detail.mnt_det_created_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_det_created_date IS 'Tgl Pembuatan';


--
-- Name: COLUMN track_maintenance_detail.mnt_det_created_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_det_created_by IS 'Dibuat Oleh';


--
-- Name: COLUMN track_maintenance_detail.mnt_det_updated_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_det_updated_date IS 'Tgl Update';


--
-- Name: COLUMN track_maintenance_detail.mnt_det_updated_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_detail.mnt_det_updated_by IS 'Diupdate Oleh';


--
-- Name: track_maintenance_detail_mnt_det_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE track_maintenance_detail_mnt_det_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.track_maintenance_detail_mnt_det_id_seq OWNER TO telkom;

--
-- Name: track_maintenance_detail_mnt_det_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE track_maintenance_detail_mnt_det_id_seq OWNED BY track_maintenance_detail.mnt_det_id;


--
-- Name: track_maintenance_evidence; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE track_maintenance_evidence (
    mnt_evd_id integer NOT NULL,
    mnt_id integer,
    mnt_evd_file character varying(100) NOT NULL,
    mnt_evd_desc text,
    mnt_evd_created_date timestamp without time zone,
    mnt_evd_created_by character varying(16),
    mnt_evd_updated_date timestamp without time zone,
    mnt_evd_updated_by character varying(16)
);


ALTER TABLE public.track_maintenance_evidence OWNER TO telkom;

--
-- Name: TABLE track_maintenance_evidence; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE track_maintenance_evidence IS 'Maintenance Evidence';


--
-- Name: COLUMN track_maintenance_evidence.mnt_evd_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_evidence.mnt_evd_id IS 'ID Maintenance Evidence';


--
-- Name: COLUMN track_maintenance_evidence.mnt_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_evidence.mnt_id IS 'ID Maintenance';


--
-- Name: COLUMN track_maintenance_evidence.mnt_evd_file; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_evidence.mnt_evd_file IS 'Evidence File';


--
-- Name: COLUMN track_maintenance_evidence.mnt_evd_desc; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_evidence.mnt_evd_desc IS 'Deskripsi';


--
-- Name: COLUMN track_maintenance_evidence.mnt_evd_created_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_evidence.mnt_evd_created_date IS 'Tgl Pembuatan';


--
-- Name: COLUMN track_maintenance_evidence.mnt_evd_created_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_evidence.mnt_evd_created_by IS 'Dibuat Oleh';


--
-- Name: COLUMN track_maintenance_evidence.mnt_evd_updated_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_evidence.mnt_evd_updated_date IS 'Tgl Update';


--
-- Name: COLUMN track_maintenance_evidence.mnt_evd_updated_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_maintenance_evidence.mnt_evd_updated_by IS 'Diupdate Oleh';


--
-- Name: track_maintenance_evidence_mnt_evd_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE track_maintenance_evidence_mnt_evd_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.track_maintenance_evidence_mnt_evd_id_seq OWNER TO telkom;

--
-- Name: track_maintenance_evidence_mnt_evd_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE track_maintenance_evidence_mnt_evd_id_seq OWNED BY track_maintenance_evidence.mnt_evd_id;


--
-- Name: track_maintenance_mnt_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE track_maintenance_mnt_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.track_maintenance_mnt_id_seq OWNER TO telkom;

--
-- Name: track_maintenance_mnt_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE track_maintenance_mnt_id_seq OWNED BY track_maintenance.mnt_id;


--
-- Name: track_req_detail; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE track_req_detail (
    req_det_id integer NOT NULL,
    req_id integer,
    req_det_pic character varying(50),
    req_det_start_date timestamp without time zone,
    req_det_due_date timestamp without time zone,
    req_det_status character varying(1),
    req_det_created_date timestamp without time zone,
    req_det_created_by character varying(16),
    req_det_updated_date timestamp without time zone,
    req_det_updated_by character varying(16),
    req_det_desc text
);


ALTER TABLE public.track_req_detail OWNER TO telkom;

--
-- Name: TABLE track_req_detail; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE track_req_detail IS 'Requirement Detail';


--
-- Name: COLUMN track_req_detail.req_det_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_req_detail.req_det_id IS 'ID Req Det';


--
-- Name: COLUMN track_req_detail.req_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_req_detail.req_id IS 'ID Requirement';


--
-- Name: COLUMN track_req_detail.req_det_pic; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_req_detail.req_det_pic IS 'PIC';


--
-- Name: COLUMN track_req_detail.req_det_start_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_req_detail.req_det_start_date IS 'Start Date';


--
-- Name: COLUMN track_req_detail.req_det_due_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_req_detail.req_det_due_date IS 'Due Date';


--
-- Name: COLUMN track_req_detail.req_det_status; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_req_detail.req_det_status IS 'Status Pengerjaan';


--
-- Name: COLUMN track_req_detail.req_det_created_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_req_detail.req_det_created_date IS 'Tgl Pembuatan';


--
-- Name: COLUMN track_req_detail.req_det_created_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_req_detail.req_det_created_by IS 'Dibuat Oleh';


--
-- Name: COLUMN track_req_detail.req_det_updated_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_req_detail.req_det_updated_date IS 'Tgl Update';


--
-- Name: COLUMN track_req_detail.req_det_updated_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_req_detail.req_det_updated_by IS 'Diupdate Oleh';


--
-- Name: track_req_detail_req_det_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE track_req_detail_req_det_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.track_req_detail_req_det_id_seq OWNER TO telkom;

--
-- Name: track_req_detail_req_det_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE track_req_detail_req_det_id_seq OWNED BY track_req_detail.req_det_id;


--
-- Name: track_requirement; Type: TABLE; Schema: public; Owner: telkom; Tablespace: 
--

CREATE TABLE track_requirement (
    req_id integer NOT NULL,
    app_id integer,
    req_desc text NOT NULL,
    req_by character varying(50),
    req_date timestamp without time zone,
    req_evidence_desc text,
    req_created_date timestamp without time zone,
    req_created_by character varying(16),
    req_updated_date timestamp without time zone,
    req_updated_by character varying(16)
);


ALTER TABLE public.track_requirement OWNER TO telkom;

--
-- Name: TABLE track_requirement; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON TABLE track_requirement IS 'Requirement';


--
-- Name: COLUMN track_requirement.req_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_requirement.req_id IS 'ID Requirement';


--
-- Name: COLUMN track_requirement.app_id; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_requirement.app_id IS 'ID Application';


--
-- Name: COLUMN track_requirement.req_desc; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_requirement.req_desc IS 'Deskripsi';


--
-- Name: COLUMN track_requirement.req_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_requirement.req_by IS 'Diminta Oleh';


--
-- Name: COLUMN track_requirement.req_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_requirement.req_date IS 'Tgl Requirement';


--
-- Name: COLUMN track_requirement.req_evidence_desc; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_requirement.req_evidence_desc IS 'Deskripsi Evident';


--
-- Name: COLUMN track_requirement.req_created_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_requirement.req_created_date IS 'Tgl Pembuatan';


--
-- Name: COLUMN track_requirement.req_created_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_requirement.req_created_by IS 'Dibuat Oleh';


--
-- Name: COLUMN track_requirement.req_updated_date; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_requirement.req_updated_date IS 'Tgl Update';


--
-- Name: COLUMN track_requirement.req_updated_by; Type: COMMENT; Schema: public; Owner: telkom
--

COMMENT ON COLUMN track_requirement.req_updated_by IS 'Diupdate Oleh';


--
-- Name: track_requirement_req_id_seq; Type: SEQUENCE; Schema: public; Owner: telkom
--

CREATE SEQUENCE track_requirement_req_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.track_requirement_req_id_seq OWNER TO telkom;

--
-- Name: track_requirement_req_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: telkom
--

ALTER SEQUENCE track_requirement_req_id_seq OWNED BY track_requirement.req_id;


--
-- Name: agama_id; Type: DEFAULT; Schema: public; Owner: sikp
--

ALTER TABLE ONLY cip_agama ALTER COLUMN agama_id SET DEFAULT nextval('cip_agama_agama_id_seq'::regclass);


--
-- Name: peg_id; Type: DEFAULT; Schema: public; Owner: sikp
--

ALTER TABLE ONLY cip_pegawai ALTER COLUMN peg_id SET DEFAULT nextval('cip_pegawai_peg_id_seq'::regclass);


--
-- Name: menu_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_menu ALTER COLUMN menu_id SET DEFAULT nextval('core_menu_menu_id_seq'::regclass);


--
-- Name: permission_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_permission ALTER COLUMN permission_id SET DEFAULT nextval('core_permission_permission_id_seq'::regclass);


--
-- Name: role_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_role ALTER COLUMN role_id SET DEFAULT nextval('core_role_role_id_seq'::regclass);


--
-- Name: rolemenu_id; Type: DEFAULT; Schema: public; Owner: sikp
--

ALTER TABLE ONLY core_role_menu ALTER COLUMN rolemenu_id SET DEFAULT nextval('core_role_menu_rolemenu_id_seq'::regclass);


--
-- Name: user_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_user ALTER COLUMN user_id SET DEFAULT nextval('core_user_user_id_seq'::regclass);


--
-- Name: var_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_variables ALTER COLUMN var_id SET DEFAULT nextval('core_variables_var_id_seq'::regclass);


--
-- Name: app_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_application ALTER COLUMN app_id SET DEFAULT nextval('track_application_app_id_seq'::regclass);


--
-- Name: evd_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_evidence ALTER COLUMN evd_id SET DEFAULT nextval('track_evidence_evd_id_seq'::regclass);


--
-- Name: faq_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_faq ALTER COLUMN faq_id SET DEFAULT nextval('track_faq_faq_id_seq'::regclass);


--
-- Name: faq_attach_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_faq_attachment ALTER COLUMN faq_attach_id SET DEFAULT nextval('track_faq_attachment_faq_attach_id_seq'::regclass);


--
-- Name: mnt_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_maintenance ALTER COLUMN mnt_id SET DEFAULT nextval('track_maintenance_mnt_id_seq'::regclass);


--
-- Name: mnt_det_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_maintenance_detail ALTER COLUMN mnt_det_id SET DEFAULT nextval('track_maintenance_detail_mnt_det_id_seq'::regclass);


--
-- Name: mnt_evd_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_maintenance_evidence ALTER COLUMN mnt_evd_id SET DEFAULT nextval('track_maintenance_evidence_mnt_evd_id_seq'::regclass);


--
-- Name: req_det_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_req_detail ALTER COLUMN req_det_id SET DEFAULT nextval('track_req_detail_req_det_id_seq'::regclass);


--
-- Name: req_id; Type: DEFAULT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_requirement ALTER COLUMN req_id SET DEFAULT nextval('track_requirement_req_id_seq'::regclass);


--
-- Data for Name: cip_agama; Type: TABLE DATA; Schema: public; Owner: sikp
--

COPY cip_agama (agama_id, agama_nama) FROM stdin;
1	Kristen
2	Islam
3	Katholik
5	Hindu
6	Budha
\.


--
-- Name: cip_agama_agama_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sikp
--

SELECT pg_catalog.setval('cip_agama_agama_id_seq', 23, true);


--
-- Data for Name: cip_pegawai; Type: TABLE DATA; Schema: public; Owner: sikp
--

COPY cip_pegawai (peg_id, agama_id, peg_nik, peg_nama, peg_tgl_lahir, peg_alamat) FROM stdin;
2	2	05501023	Leo Bandung	1987-03-14 00:00:00	cijerah
1	1	05501033	Wiliam Decosta Ornae	1987-07-10 00:00:00	test
4	2	05501243	Hilman Farid	2015-04-30 00:00:00	test
\.


--
-- Name: cip_pegawai_peg_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sikp
--

SELECT pg_catalog.setval('cip_pegawai_peg_id_seq', 4, true);


--
-- Data for Name: core_menu; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY core_menu (menu_id, menu_pid, menu_code, menu_file_name, menu_listing_no, menu_is_active, menu_description, menu_creation_date, menu_creation_by, menu_updated_date, menu_updated_by, menu_level, menu_path) FROM stdin;
2	\N	Pengaturan Sistem	-	1	Y	Pengaturan Sistem	2015-05-06 00:00:00	developer	2015-05-06 00:00:00	developer	1	2
3	2	User &amp; Group	-	1	Y		2015-05-06 00:00:00	developer	2015-05-06 00:00:00	developer	2	2.1
4	2	Modul &amp; Menu	-	2	Y		2015-05-06 00:00:00	developer	2015-05-06 00:00:00	developer	2	2.2
6	3	Pengaturan Group	role	2	Y		2015-05-06 00:00:00	developer	2015-05-06 00:00:00	developer	3	2.1.2
7	4	Pengaturan Modul	permission	1	Y		2015-05-06 00:00:00	developer	2015-05-06 00:00:00	developer	3	2.2.1
8	4	Pengaturan Menu	menu	2	Y		2015-05-06 00:00:00	developer	2015-05-06 00:00:00	developer	3	2.2.2
5	3	Pengaturan User	user	1	Y		2015-05-06 00:00:00	developer	2015-05-06 00:00:00	developer	3	2.1.1
9	\N	Referensi	-	2	Y		2015-11-02 00:00:00	developer	2015-11-02 00:00:00	developer	1	9
10	9	Application	application	1	Y		2015-11-02 00:00:00	developer	2015-11-02 00:00:00	developer	2	9.1
12	11	FAQ	faq	1	Y		2015-11-02 00:00:00	developer	2015-11-02 00:00:00	developer	2	11.1
13	11	Requirement	requirement	2	Y		2015-11-02 00:00:00	developer	2015-11-02 00:00:00	developer	2	11.2
11	\N	Services	-	3	Y		2015-11-02 00:00:00	developer	2015-11-04 00:00:00	developer	1	11
14	11	Maintenance	maintenance	3	Y		2015-11-04 00:00:00	developer	2015-11-04 00:00:00	developer	2	11.3
\.


--
-- Name: core_menu_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('core_menu_menu_id_seq', 14, true);


--
-- Data for Name: core_permission; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY core_permission (permission_id, permission_name, permission_desc, permission_module) FROM stdin;
1	Permission	Register Hak Akses	base
2	Role	Grup/Peran Pengguna	base
3	RolePermission	Hak Akses Grup	base
4	Sessions	Sessions	base
5	User	Users	base
6	UserPermission	Hak Akses User	base
7	UserRole	Grup User	base
8	Variables	System Variables	base
\.


--
-- Name: core_permission_permission_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('core_permission_permission_id_seq', 26, true);


--
-- Data for Name: core_role; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY core_role (role_id, role_name, role_status) FROM stdin;
1	Administrator	a
2	Operator	a
\.


--
-- Data for Name: core_role_menu; Type: TABLE DATA; Schema: public; Owner: sikp
--

COPY core_role_menu (rolemenu_id, role_id, menu_id, rolemenu_status, rolemenu_creation_date, rolemenu_creation_by, rolemenu_updated_date, rolemenu_updated_by) FROM stdin;
2	2	2	T	2015-11-02 00:00:00	developer	2015-11-02 00:00:00	developer
3	2	11	Y	2015-11-02 00:00:00	developer	2015-11-02 00:00:00	developer
4	2	12	Y	2015-11-02 00:00:00	developer	2015-11-02 00:00:00	developer
5	2	13	Y	2015-11-02 00:00:00	developer	2015-11-02 00:00:00	developer
6	2	9	Y	2015-11-02 00:00:00	developer	2015-11-02 00:00:00	developer
7	2	10	Y	2015-11-02 00:00:00	developer	2015-11-02 00:00:00	developer
8	2	14	Y	2015-11-04 00:00:00	developer	2015-11-04 00:00:00	developer
\.


--
-- Name: core_role_menu_rolemenu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sikp
--

SELECT pg_catalog.setval('core_role_menu_rolemenu_id_seq', 8, true);


--
-- Data for Name: core_role_permission; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY core_role_permission (role_id, permission_id, permission_level) FROM stdin;
1	1	6
1	2	6
1	3	6
1	4	6
1	5	6
1	6	6
1	7	6
1	8	6
\.


--
-- Name: core_role_role_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('core_role_role_id_seq', 3, true);


--
-- Data for Name: core_sessions; Type: TABLE DATA; Schema: public; Owner: sikp
--

COPY core_sessions (session_id, ip_address, user_agent, last_activity, user_data) FROM stdin;
42192a8a555bc1646caccf97845d6f0e	202.134.2.11	Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36	1463732379	a:7:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"11";s:9:"user_name";s:5:"adang";s:13:"user_realname";s:19:"Adang Surya Saputra";s:10:"user_email";s:14:"adang@none.com";s:9:"logged_in";b:1;s:5:"roles";a:1:{i:0;a:2:{s:7:"role_id";s:1:"1";s:9:"role_name";s:13:"Administrator";}}}
\.


--
-- Data for Name: core_user; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY core_user (user_id, user_name, user_password, user_email, user_realname, user_status) FROM stdin;
1	developer	ecb768ce58c34f0ad90735a5ed6b5094	wiliamdecosta@gmail.com	Developer	a
8	rendi	d209fc47646bba5e5fdc3d3bbaad4b9c	rendi@none.com	Rendi	a
9	umar	3f011c233957dfba24d6b2d5d653aa6c	umar@none.com	Umar	a
10	gery	ea17456b3cb4dc448cf7fc158e863a4f	gery@none.com	Tiffano Isya Gery	a
2	operator	4b583376b2767b923c3e1da60d10de59	operator@none.com	Operator	a
7	ninoy	37534707a1722a914dac96ed0f73bc42	ninoy@none.com	Ninoy Harun	a
12	wiliam	ecb768ce58c34f0ad90735a5ed6b5094	wiliamdecosta@gmail.com	Wiliam Decosta	a
11	adang	805c83360a951c7208f1ee054784cedd	adang@none.com	Adang Surya Saputra	a
\.


--
-- Data for Name: core_user_permission; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY core_user_permission (user_id, permission_id, permission_level) FROM stdin;
\.


--
-- Data for Name: core_user_role; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY core_user_role (user_id, role_id, main_role) FROM stdin;
1	1	1
2	2	1
7	2	1
8	2	1
9	2	1
10	2	1
11	1	1
12	1	1
\.


--
-- Name: core_user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('core_user_user_id_seq', 12, true);


--
-- Data for Name: core_variables; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY core_variables (var_id, var_component, var_name, var_value, var_type) FROM stdin;
\.


--
-- Name: core_variables_var_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('core_variables_var_id_seq', 1, false);


--
-- Data for Name: track_application; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY track_application (app_id, app_name, app_created_date, app_created_by, app_updated_date, app_updated_by) FROM stdin;
4	TIBS NON POTS	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
5	MATIC	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
6	More For Less (M4L)	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
7	TIBS NTS	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
8	Marketing Fee	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
9	GLOBAL MSU	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
10	GLOBAL IN (VAS)	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
11	GLOBAL INCOMING (Interkoneksi)	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
12	GLOBAL OUTGOING (Interkoneksi)	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
13	SMS HUBBER	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
14	UTIBS	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
15	PROJECT MIGRASI REPORT NONPOTS	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
16	PROJECT MPD	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
17	PEKERJAAN AFIS	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
18	TIBS WS IDD	2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang
\.


--
-- Name: track_application_app_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('track_application_app_id_seq', 18, true);


--
-- Data for Name: track_evidence; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY track_evidence (evd_id, req_id, evd_file, evd_desc, evd_created_date, evd_created_by, evd_updated_date, evd_updated_by) FROM stdin;
6	2	20151103_mom_enhancement_tos_non_pots_-_20151027_(1).pdf	Mom dari FBCC	2015-11-03 00:00:00	adang	2015-11-03 00:00:00	adang
\.


--
-- Name: track_evidence_evd_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('track_evidence_evd_id_seq', 6, true);


--
-- Data for Name: track_faq; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY track_faq (faq_id, app_id, faq_case_name, faq_case_by, faq_case_date, faq_solution, faq_solution_by, faq_solution_finish_date, faq_description, faq_created_date, faq_created_by, faq_updated_date, faq_updated_by) FROM stdin;
\.


--
-- Data for Name: track_faq_attachment; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY track_faq_attachment (faq_attach_id, faq_id, faq_attach_file, faq_attach_desc, faq_attach_created_date, faq_attach_created_by, faq_attach_updated_date, faq_attach_updated_by) FROM stdin;
\.


--
-- Name: track_faq_attachment_faq_attach_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('track_faq_attachment_faq_attach_id_seq', 7, true);


--
-- Name: track_faq_faq_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('track_faq_faq_id_seq', 3, true);


--
-- Data for Name: track_maintenance; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY track_maintenance (mnt_id, app_id, mnt_desc, mnt_by, mnt_date, mnt_evidence_desc, mnt_created_date, mnt_created_by, mnt_updated_date, mnt_updated_by) FROM stdin;
2	8	Menu Putty 1. Load data bulanan (Trem Rekap Reg-ALL)\n                   2. Load data ND tambahan\n                   3. Menu 5 flag payment\n	Bu Monic	2015-08-19 00:00:00	Mengacu ke MOM markterting Fee terkait perubahan structure TREMS-REKAP REG-ALL	2015-11-10 00:00:00	rendi	2015-11-10 00:00:00	rendi
3	8	Update Expense ND baru DTN, FX, PI (tenant) --&gt; 201502 - 201509	Mas Fauzi (Bu Monic)	2015-10-28 00:00:00	Via telegram Goup (Marketing Fee &amp; Japri (Mas Fauzi))	2015-11-10 00:00:00	rendi	2015-11-10 00:00:00	rendi
4	13	Enhance Notifikasi Hubber (Report File Email)	FBCC (Welly)	2015-10-31 00:00:00	By WA	2015-11-10 00:00:00	rendi	2015-11-10 00:00:00	rendi
5	4	MIGRASI IFRS NONPOTS	ANDIONO	2015-11-10 00:00:00		2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
6	13	Enhance load dashboard BLN April 	FBCC (Welly) via Andiono	2015-10-31 00:00:00	Via WA 	2015-11-10 00:00:00	rendi	2015-11-10 00:00:00	rendi
7	13	Enhanced Load balancing (scheduler)	FBCC (Welly) via andiono	2015-10-31 00:00:00	Via WA	2015-11-10 00:00:00	rendi	2015-11-10 00:00:00	rendi
8	13	Reproses STI Juni (Dengan rule yang lama --&gt; case bln juni )	FBCC (Welly) via andiono	2015-10-31 00:00:00	Via WA	2015-11-10 00:00:00	rendi	2015-11-10 00:00:00	rendi
9	9	Tambah Menu Create File Text detail transaksi, dan menu setting partner id untuk Posting	FUAD	2015-10-18 00:00:00		2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
10	8	Update Expence 201510 untuk tenant PI	FAUZI by Bu Monic	2015-11-11 00:00:00	Telegram 	2015-11-11 00:00:00	rendi	2015-11-11 00:00:00	rendi
\.


--
-- Data for Name: track_maintenance_detail; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY track_maintenance_detail (mnt_det_id, mnt_id, mnt_det_pic, mnt_det_desc, mnt_det_start_date, mnt_det_due_date, mnt_det_status, mnt_det_created_date, mnt_det_created_by, mnt_det_updated_date, mnt_det_updated_by) FROM stdin;
2	8	Rendi		2015-11-02 00:00:00	2015-11-03 00:00:00	C	2015-11-10 00:00:00	rendi	2015-11-10 00:00:00	rendi
4	6	RENDI		2015-11-02 00:00:00	2015-11-03 00:00:00	C	2015-11-10 00:00:00	rendi	2015-11-10 00:00:00	rendi
3	7	RENDI	Closed	2015-11-02 00:00:00	2015-11-03 00:00:00	C	2015-11-10 00:00:00	rendi	2015-11-10 00:00:00	rendi
5	4	Rendi		2015-11-02 00:00:00	2015-11-02 00:00:00	C	2015-11-10 00:00:00	rendi	2015-11-10 00:00:00	rendi
6	5	ADANG, NITRA	Buat Script Migrasi	2015-11-08 00:00:00	2015-11-13 00:00:00	C	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
7	5	UMAR	POPULATE data yang akan Dimigrasi	2015-11-08 00:00:00	2015-11-13 00:00:00	I	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
8	5	RENDI	BILLTEST sebelum migrasi	2015-11-10 00:00:00	2015-11-13 00:00:00	B	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
9	5	ADANG, UMAR	Eksekusi Migrasi	2015-11-10 00:00:00	2015-11-13 00:00:00	B	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
10	5	RENDI	BILLTEST PASCA MIGRASI	2015-11-10 00:00:00	2015-11-13 00:00:00	B	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
12	9	ANDREA, ADANG	Ubah Form Parameter Tiering menambahkan kolom Partner SOKI dan ubah script posting	2015-10-23 00:00:00	2015-10-30 00:00:00	C	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
11	9	ADANG, GERI	Tambah Menu Create File Text, Buat Script Write File Paralel	2015-10-23 00:00:00	2015-10-30 00:00:00	C	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
13	3	RENDI		\N	\N		2015-11-11 00:00:00	rendi	2015-11-11 00:00:00	rendi
14	10	RENDI		2015-11-11 00:00:00	2015-11-12 00:00:00	C	2015-11-11 00:00:00	rendi	2015-11-11 00:00:00	rendi
\.


--
-- Name: track_maintenance_detail_mnt_det_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('track_maintenance_detail_mnt_det_id_seq', 14, true);


--
-- Data for Name: track_maintenance_evidence; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY track_maintenance_evidence (mnt_evd_id, mnt_id, mnt_evd_file, mnt_evd_desc, mnt_evd_created_date, mnt_evd_created_by, mnt_evd_updated_date, mnt_evd_updated_by) FROM stdin;
2	9	20151110_hasil_evaluasi_billing_trafik_september_2015.docx	dari email tgl 23 oct 2015	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
\.


--
-- Name: track_maintenance_evidence_mnt_evd_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('track_maintenance_evidence_mnt_evd_id_seq', 2, true);


--
-- Name: track_maintenance_mnt_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('track_maintenance_mnt_id_seq', 10, true);


--
-- Data for Name: track_req_detail; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY track_req_detail (req_det_id, req_id, req_det_pic, req_det_start_date, req_det_due_date, req_det_status, req_det_created_date, req_det_created_by, req_det_updated_date, req_det_updated_by, req_det_desc) FROM stdin;
7	3	RENDI, UMAR, GERI, WILLIAM, ADANG	2015-11-15 00:00:00	\N	B	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang	Preparation, Asessment Aplikasi (Form PHP), Asessment Database, Kik-Off Meeting
8	3	RENDI, UMAR, GERI, WILLIAM, ADANG	2015-11-15 00:00:00	\N	B	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang	Migrasi Database, Create Schema, Create Tablespace, Migrasi Object DB terakit User Management, Migrasi Object DB terakit report
9	3	RENDI, UMAR, GERI, WILLIAM, ADANG	2015-11-15 00:00:00	\N	B	2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang	Migrasi Aplikasi, Install Apache, Instal PHP, Kunfigurasi Webserver
10	6	ADANG	2016-05-20 00:00:00	2016-05-23 00:00:00	I	2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang	 1.  pemintaan supaya billing burstable bisa di run dari sysmon dengan spesifikasi bisa pilih akun dan produk yang mau dibill dan bisa pilih mau dibill dengan metode avg atau metode perc95
11	6	ADANG	2016-05-24 00:00:00	2016-05-27 00:00:00	B	2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang	2. progress checklist persiapan iepl burstable\n untuk iepl yang sekarang sudah bisa capture usage dan bill manual hitung pake query/excell
12	10	ADANG	2016-05-20 00:00:00	2016-06-17 00:00:00	I	2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang	
13	11	UMAR	2016-05-20 00:00:00	2016-06-17 00:00:00		2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang	Supervisi front End new M4L
\.


--
-- Name: track_req_detail_req_det_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('track_req_detail_req_det_id_seq', 13, true);


--
-- Data for Name: track_requirement; Type: TABLE DATA; Schema: public; Owner: telkom
--

COPY track_requirement (req_id, app_id, req_desc, req_by, req_date, req_evidence_desc, req_created_date, req_created_by, req_updated_date, req_updated_by) FROM stdin;
2	4	Enhancement TOS Non Pots	FBCC	2015-11-02 00:00:00	MOM --- Tgl 	2015-11-03 00:00:00	adang	2015-11-10 00:00:00	adang
3	15	Project Migrasi WEB TOS REPORT NONPOTS (COLODB) (WEB dan DB) menjadi apliaksi tersendiri plus enhancement tampilan.	ANDIONO	2015-11-02 00:00:00		2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
4	8	Project Marketing Fee	DESC	2015-11-01 00:00:00		2015-11-10 00:00:00	adang	2015-11-10 00:00:00	adang
6	7	Burst table	Andiono	2016-05-20 00:00:00	Pak Andiono Ysh,\n\nMohon infonya, untuk yang ini sudah disystemkan atau blm ya?\nAkun ini diminta dihitungkan dengan percentile 95 (sudah  saya kirim logic/query nya via email tgl  1 April 2016 )\n\nTadi aku kontak P Dydy sepertinya manualnya juga belum dikirim ke beliau.\nSementara untuk perhitungan manual akan aku kirimkan dulu ke Pak Dydy CS\n\nBisa minta tolong dimasukkan ke pengelolaan burstable yang kabarnya lagi diproses P Fuad dan tim P Fopo?\nRequirementnya adalah agar perhitungan burstable untuk bisa dirun dari sysmon dengan bisa dipilih akun mana akan menggunakan skema perhitungan mana (average/burstable)\nFYI kalau tidak salah, diminta sudah bisa by system di billing Mei , mungkin bisa diupayakan di Juni?\n\nDemikian disampaikan, terimakasih\n\nSalam,\nDwi A	2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang
7	4	MO perubahan tarif. 	Andiono	2016-05-19 00:00:00		2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang
8	18	XDA	FOPO	2016-04-20 00:00:00		2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang
9	8	Rule WF	Project	2016-05-15 00:00:00		2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang
10	6	Buat Back End Process	Andiono	2016-05-20 00:00:00		2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang
11	6	Project New M4L Front End	Andiono	2016-05-20 00:00:00		2016-05-20 00:00:00	adang	2016-05-20 00:00:00	adang
\.


--
-- Name: track_requirement_req_id_seq; Type: SEQUENCE SET; Schema: public; Owner: telkom
--

SELECT pg_catalog.setval('track_requirement_req_id_seq', 11, true);


--
-- Name: core_role_menu_pkey; Type: CONSTRAINT; Schema: public; Owner: sikp; Tablespace: 
--

ALTER TABLE ONLY core_role_menu
    ADD CONSTRAINT core_role_menu_pkey PRIMARY KEY (rolemenu_id);


--
-- Name: core_sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: sikp; Tablespace: 
--

ALTER TABLE ONLY core_sessions
    ADD CONSTRAINT core_sessions_pkey PRIMARY KEY (session_id);


--
-- Name: p_key_agama_id; Type: CONSTRAINT; Schema: public; Owner: sikp; Tablespace: 
--

ALTER TABLE ONLY cip_agama
    ADD CONSTRAINT p_key_agama_id PRIMARY KEY (agama_id);


--
-- Name: p_key_pegawai_id; Type: CONSTRAINT; Schema: public; Owner: sikp; Tablespace: 
--

ALTER TABLE ONLY cip_pegawai
    ADD CONSTRAINT p_key_pegawai_id PRIMARY KEY (peg_id);


--
-- Name: pk_core_menu; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY core_menu
    ADD CONSTRAINT pk_core_menu PRIMARY KEY (menu_id);


--
-- Name: pk_core_permission; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY core_permission
    ADD CONSTRAINT pk_core_permission PRIMARY KEY (permission_id);


--
-- Name: pk_core_role; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY core_role
    ADD CONSTRAINT pk_core_role PRIMARY KEY (role_id);


--
-- Name: pk_core_role_permission; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY core_role_permission
    ADD CONSTRAINT pk_core_role_permission PRIMARY KEY (role_id, permission_id);


--
-- Name: pk_core_user; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY core_user
    ADD CONSTRAINT pk_core_user PRIMARY KEY (user_id);


--
-- Name: pk_core_user_permission; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY core_user_permission
    ADD CONSTRAINT pk_core_user_permission PRIMARY KEY (user_id, permission_id);


--
-- Name: pk_core_user_role; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY core_user_role
    ADD CONSTRAINT pk_core_user_role PRIMARY KEY (user_id, role_id);


--
-- Name: pk_core_variables; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY core_variables
    ADD CONSTRAINT pk_core_variables PRIMARY KEY (var_id);


--
-- Name: pk_track_application; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY track_application
    ADD CONSTRAINT pk_track_application PRIMARY KEY (app_id);


--
-- Name: pk_track_evidence; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY track_evidence
    ADD CONSTRAINT pk_track_evidence PRIMARY KEY (evd_id);


--
-- Name: pk_track_faq; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY track_faq
    ADD CONSTRAINT pk_track_faq PRIMARY KEY (faq_id);


--
-- Name: pk_track_faq_attachment; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY track_faq_attachment
    ADD CONSTRAINT pk_track_faq_attachment PRIMARY KEY (faq_attach_id);


--
-- Name: pk_track_maintenance; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY track_maintenance
    ADD CONSTRAINT pk_track_maintenance PRIMARY KEY (mnt_id);


--
-- Name: pk_track_maintenance_detail; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY track_maintenance_detail
    ADD CONSTRAINT pk_track_maintenance_detail PRIMARY KEY (mnt_det_id);


--
-- Name: pk_track_maintenance_evidence; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY track_maintenance_evidence
    ADD CONSTRAINT pk_track_maintenance_evidence PRIMARY KEY (mnt_evd_id);


--
-- Name: pk_track_req_detail; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY track_req_detail
    ADD CONSTRAINT pk_track_req_detail PRIMARY KEY (req_det_id);


--
-- Name: pk_track_requirement; Type: CONSTRAINT; Schema: public; Owner: telkom; Tablespace: 
--

ALTER TABLE ONLY track_requirement
    ADD CONSTRAINT pk_track_requirement PRIMARY KEY (req_id);


--
-- Name: core_menu_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX core_menu_pk ON core_menu USING btree (menu_id);


--
-- Name: core_permission_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX core_permission_pk ON core_permission USING btree (permission_id);


--
-- Name: core_role_permission_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX core_role_permission_pk ON core_role_permission USING btree (role_id, permission_id);


--
-- Name: core_role_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX core_role_pk ON core_role USING btree (role_id);


--
-- Name: core_user_permission_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX core_user_permission_pk ON core_user_permission USING btree (user_id, permission_id);


--
-- Name: core_user_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX core_user_pk ON core_user USING btree (user_id);


--
-- Name: core_user_role_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX core_user_role_pk ON core_user_role USING btree (user_id, role_id);


--
-- Name: core_variables_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX core_variables_pk ON core_variables USING btree (var_id);


--
-- Name: r1_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX r1_fk ON track_faq USING btree (app_id);


--
-- Name: r2_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX r2_fk ON track_faq_attachment USING btree (faq_id);


--
-- Name: r3_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX r3_fk ON track_requirement USING btree (app_id);


--
-- Name: r4_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX r4_fk ON track_evidence USING btree (req_id);


--
-- Name: r5_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX r5_fk ON track_req_detail USING btree (req_id);


--
-- Name: r6_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX r6_fk ON track_maintenance USING btree (app_id);


--
-- Name: r7_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX r7_fk ON track_maintenance_evidence USING btree (mnt_id);


--
-- Name: r8_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX r8_fk ON track_maintenance_detail USING btree (mnt_id);


--
-- Name: role_permission2_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX role_permission2_fk ON core_role_permission USING btree (permission_id);


--
-- Name: role_permission_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX role_permission_fk ON core_role_permission USING btree (role_id);


--
-- Name: track_application_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX track_application_pk ON track_application USING btree (app_id);


--
-- Name: track_evidence_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX track_evidence_pk ON track_evidence USING btree (evd_id);


--
-- Name: track_faq_attachment_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX track_faq_attachment_pk ON track_faq_attachment USING btree (faq_attach_id);


--
-- Name: track_faq_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX track_faq_pk ON track_faq USING btree (faq_id);


--
-- Name: track_maintenance_detail_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX track_maintenance_detail_pk ON track_maintenance_detail USING btree (mnt_det_id);


--
-- Name: track_maintenance_evidence_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX track_maintenance_evidence_pk ON track_maintenance_evidence USING btree (mnt_evd_id);


--
-- Name: track_maintenance_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX track_maintenance_pk ON track_maintenance USING btree (mnt_id);


--
-- Name: track_req_detail_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX track_req_detail_pk ON track_req_detail USING btree (req_det_id);


--
-- Name: track_requirement_pk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE UNIQUE INDEX track_requirement_pk ON track_requirement USING btree (req_id);


--
-- Name: user_permission2_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX user_permission2_fk ON core_user_permission USING btree (permission_id);


--
-- Name: user_permission_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX user_permission_fk ON core_user_permission USING btree (user_id);


--
-- Name: user_role2_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX user_role2_fk ON core_user_role USING btree (role_id);


--
-- Name: user_role_fk; Type: INDEX; Schema: public; Owner: telkom; Tablespace: 
--

CREATE INDEX user_role_fk ON core_user_role USING btree (user_id);


--
-- Name: f_key_agama_id; Type: FK CONSTRAINT; Schema: public; Owner: sikp
--

ALTER TABLE ONLY cip_pegawai
    ADD CONSTRAINT f_key_agama_id FOREIGN KEY (agama_id) REFERENCES cip_agama(agama_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_core_menu_app; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_menu
    ADD CONSTRAINT fk_core_menu_app FOREIGN KEY (menu_pid) REFERENCES core_menu(menu_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_core_rol_role_perm_core_per; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_role_permission
    ADD CONSTRAINT fk_core_rol_role_perm_core_per FOREIGN KEY (permission_id) REFERENCES core_permission(permission_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_core_rol_role_perm_core_rol; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_role_permission
    ADD CONSTRAINT fk_core_rol_role_perm_core_rol FOREIGN KEY (role_id) REFERENCES core_role(role_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_core_use_user_perm_core_per; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_user_permission
    ADD CONSTRAINT fk_core_use_user_perm_core_per FOREIGN KEY (permission_id) REFERENCES core_permission(permission_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_core_use_user_perm_core_use; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_user_permission
    ADD CONSTRAINT fk_core_use_user_perm_core_use FOREIGN KEY (user_id) REFERENCES core_user(user_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_core_use_user_role_core_rol; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_user_role
    ADD CONSTRAINT fk_core_use_user_role_core_rol FOREIGN KEY (role_id) REFERENCES core_role(role_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_core_use_user_role_core_use; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY core_user_role
    ADD CONSTRAINT fk_core_use_user_role_core_use FOREIGN KEY (user_id) REFERENCES core_user(user_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_track_ev_r4_track_re; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_evidence
    ADD CONSTRAINT fk_track_ev_r4_track_re FOREIGN KEY (req_id) REFERENCES track_requirement(req_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_track_fa_r1_track_ap; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_faq
    ADD CONSTRAINT fk_track_fa_r1_track_ap FOREIGN KEY (app_id) REFERENCES track_application(app_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_track_fa_r2_track_fa; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_faq_attachment
    ADD CONSTRAINT fk_track_fa_r2_track_fa FOREIGN KEY (faq_id) REFERENCES track_faq(faq_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_track_ma_r6_track_ap; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_maintenance
    ADD CONSTRAINT fk_track_ma_r6_track_ap FOREIGN KEY (app_id) REFERENCES track_application(app_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_track_ma_r7_track_ma; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_maintenance_evidence
    ADD CONSTRAINT fk_track_ma_r7_track_ma FOREIGN KEY (mnt_id) REFERENCES track_maintenance(mnt_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_track_ma_r8_track_ma; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_maintenance_detail
    ADD CONSTRAINT fk_track_ma_r8_track_ma FOREIGN KEY (mnt_id) REFERENCES track_maintenance(mnt_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_track_re_r3_track_ap; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_requirement
    ADD CONSTRAINT fk_track_re_r3_track_ap FOREIGN KEY (app_id) REFERENCES track_application(app_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_track_re_r5_track_re; Type: FK CONSTRAINT; Schema: public; Owner: telkom
--

ALTER TABLE ONLY track_req_detail
    ADD CONSTRAINT fk_track_re_r5_track_re FOREIGN KEY (req_id) REFERENCES track_requirement(req_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: public; Type: ACL; Schema: -; Owner: enterprisedb
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM enterprisedb;
GRANT ALL ON SCHEMA public TO enterprisedb;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- EnterpriseDB database dump complete
--

