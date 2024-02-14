import redis
import time 
import mysql.connector

# Connexion à Redis
redis_client = redis.StrictRedis(host='localhost', port=6379, db=0)
WINDOW_DURATION = 10 * 60

# Connexion à la base de données MySQL
mysql_connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="utilisateurs"
)
mysql_cursor = mysql_connection.cursor()

def verifier_autorisation_utilisateur(nom_utilisateur):
    utilisateurs_autorises = ['Dupont', 'Martin', 'Lefebvre']  
    return nom_utilisateur in utilisateurs_autorises

def gerer_connexion_utilisateur(nom_utilisateur):
    timestamp_actuel = int(time.time())
    fin_fenetre = timestamp_actuel + WINDOW_DURATION
    
    cle_utilisateur = f"connexion:{nom_utilisateur}"
    
    nombre_connexions = redis_client.get(cle_utilisateur)
    if nombre_connexions is not None and int(nombre_connexions) >= 10:
        print("L'utilisateur a déjà atteint le nombre maximal de connexions dans la fenêtre de 10 minutes.")
        return False
    
    redis_client.incr(cle_utilisateur)
    redis_client.expireat(cle_utilisateur, fin_fenetre)
    
    print("L'utilisateur est connecté.")
    return True


