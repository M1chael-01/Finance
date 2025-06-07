# README - Nastavení finanční aplikace --- verse CS 

Tento návod Vám poskytne podrobné pokyny, jak nastavit a spustit webový projekt na Vašem počítači pomocí XAMPP. Kromě toho se dozvíte, jak importovat potřebné databázové SQL skripty, abyste mohli aplikaci plně využívat. Po úspěšném nastavení budete mít přístup k plně funkční aplikaci, která slouží k efektivní správě osobních či firemních finančních údajů, včetně sledování příjmů, výdajů a generování různých finančních přehledů.

## Požadavky

Aby aplikace fungovala správně, je potřeba mít nainstalované následující:

- **XAMPP**: Je to snadno použitelné balíkové řešení obsahující Apache, MySQL a PHP, které je ideální pro běh webových aplikací na lokálním počítači.
- **Webový prohlížeč**: Aplikaci budete moci přistupovat prostřednictvím běžného webového prohlížeče, jako je Google Chrome, Mozilla Firefox nebo jiný moderní prohlížeč.
- **Přístup k SQL skriptům**: Databázové skripty, které jsou součástí projektu, umožní vytvoření požadovaných databázových tabulek a struktur pro správu dat.
- **Přístup k internetu**: Aplikace může vyžadovat připojení k internetu pro stažení potřebných knihoven, aktualizací nebo pro integraci s externími službami (například pro zasílání e-mailů nebo ověřování aktualizací). Ujistěte se, že Vaše zařízení je připojeno k internetu během instalace a při prvním spuštění aplikace.

## Kroky

### Krok 1: Spuštění XAMPP serveru

1. **Otevřete XAMPP**: Spusťte aplikaci XAMPP na Vašem počítači.
2. **Spusťte Apache a MySQL**:
   - Klikněte na tlačítko **Start** vedle Apache (to je webový server) a MySQL (to je databázový server).
   - Po spuštění by měl být stav obou služeb označen zelenou barvou, což znamená, že vše funguje správně. Pokud by se některá služba nespustila, zkontrolujte, zda nejsou porty Apache nebo MySQL blokovány jinými aplikacemi.

### Krok 2: Přístup do databáze

1. Otevřete webový prohlížeč a přejděte na adresu:  
   `http://localhost/phpmyadmin/index.php`
2. Tento odkaz Vás přesměruje na administrační rozhraní pro správu MySQL databáze, kde budete moci importovat SQL skripty, které vytvoří potřebné tabulky a databáze pro aplikaci.

### Krok 3: Vytvoření databází

1. V prohlížeči otevřete tuto adresu:  
   `http://localhost/phpmyadmin/index.php?route=/server/sql`
2. Vložte SQL kódy, které naleznete ve složce `SQL`, do textového pole. **Každý SQL skript vkládejte zvlášť**, ne všechny najednou, aby bylo možné provést správnou inicializaci databáze.
3. Po vložení SQL kódu klikněte na tlačítko **Proveďte** (nebo v anglické verzi **Go**).
   - Tento krok vytvoří všechny potřebné databázové struktury a tabulky, které aplikace používá pro správu dat.

### Krok 4: Nastavení webového projektu

1. Přejděte do složky, kde máte uložený svůj webový projekt.
2. Zkontrolujte, zda máte všechny potřebné soubory, které aplikace vyžaduje pro správnou funkci. Ověřte, že složky nejsou prázdné a že všechny soubory jsou na správném místě. Pokud některé soubory chybí, zkontrolujte jejich umístění nebo stáhněte poslední verzi projektu.

### Krok 5: Otestování webového projektu

1. Otevřete webový prohlížeč a přejděte na adresu:  
   `http://localhost/{nazev-projektu}`
2. Pokud je všechno správně nastaveno, měla by se Vám zobrazit hlavní stránka webového projektu. Pokud se stránka nezobrazí nebo se objeví chyba, zkontrolujte, zda jste správně postupovali podle předchozích kroků. Nejčastější chyby zahrnují problémy s konfigurací databáze nebo nesprávně nastavený webový server.

## Jak aplikace funguje

Aplikace je navržena pro efektivní správu rodinných financí. Umožňuje uživatelům snadno sledovat příjmy, výdaje a generovat detailní přehledy o jejich finanční situaci. Aplikace je vybavena intuitivním uživatelským rozhraním, které usnadňuje zadávání transakcí a správu finančních dat.

1. **Uživatelské rozhraní**: Aplikace poskytuje jednoduché a přehledné rozhraní pro zadávání nových transakcí. Uživatelé mohou snadno zadávat příjmy a výdaje a přiřazovat je k různým kategoriím.
2. **Databázová struktura**: Všechny informace o transakcích jsou uloženy v databázi, což umožňuje aplikaci rychlý a efektivní přístup k datům. 
3. **Generování reportů**: Na základě zadaných dat aplikace automaticky generuje přehledy a reporty o financích, které poskytují uživatelům jasný obraz o jejich příjmech, výdajích a úsporách. Tyto reporty jsou nezbytné pro analýzu finanční situace a plánování budoucích kroků.

Aplikace je navržena tak, aby byla maximálně uživatelsky přívětivá a umožnila efektivní správu financí bez potřeby pokročilých znalostí.

&copy; **Tvrdík Michael 2025**, Všechna práva vyhrazena.

-------------------------------------------------------------------------------------------------------------------------------------------------------------------

# README – Financial App Setup Guide ---- verse ENs

This guide provides step-by-step instructions on how to set up and run the financial web application on your local machine using **XAMPP**. Additionally, it explains how to import the necessary SQL scripts to enable full functionality of the application.

Once the setup is complete, you’ll have access to a fully functional application designed for efficient management of personal or business financial data, including income and expense tracking and generating various financial reports.

---

## Requirements

To ensure proper functionality of the application, please make sure you have the following installed:

- **XAMPP**: A simple package containing Apache, MySQL, and PHP, ideal for running web applications locally.
- **Web Browser**: You can access the app using any modern browser like Google Chrome, Mozilla Firefox, etc.
- **SQL Scripts**: The project includes database scripts necessary to create the tables and structure for data management.
- **Internet Connection**: The app may require internet access for downloading libraries, updates, or integrating external services (e.g., email sending or update checks). Please ensure your device is online during installation and the first run.

---

## Steps

### Step 1: Start the XAMPP Server

1. **Launch XAMPP** on your computer.
2. Start the **Apache** (web server) and **MySQL** (database server) services by clicking **Start** next to each.
   - Both services should turn green when running correctly. If one fails to start, check for port conflicts (e.g., Skype or other software might be using required ports).

### Step 2: Access the Database

1. Open your browser and go to:  
   `http://localhost/phpmyadmin/index.php`
2. This link takes you to the phpMyAdmin interface, where you can manage your MySQL database and import the required SQL scripts.

### Step 3: Import SQL Scripts

1. Visit:  
   `http://localhost/phpmyadmin/index.php?route=/server/sql`
2. Copy and paste the SQL code from the `SQL` folder into the input field.  
   **Import each script one by one** to ensure correct database initialization.
3. Click **Go** to execute the script.
   - This will create the required tables and structures needed for the application to manage your data.

### Step 4: Set Up the Web Project

1. Navigate to the folder containing your web project.
2. Ensure all necessary files are present and in the correct locations. If something is missing, check the source or download the latest version of the project.

### Step 5: Test the Web Application

1. Open your browser and go to:  
   `http://localhost/{project-name}`
2. If everything is set up correctly, the homepage of your project should appear.  
   If you see an error, double-check the previous steps — common issues include database connection errors or misconfigured web server settings.

---

## How the Application Works

This financial app is built to help users manage household or business finances efficiently. It provides tools to track income, expenses, and generate detailed reports.

1. **User Interface**: The app features a clean and intuitive UI for entering transactions. Users can easily log income and expenses and assign them to categories.
2. **Database Structure**: All transaction data is stored in a structured database, ensuring fast and efficient data handling.
3. **Report Generation**: Based on user inputs, the app automatically generates clear financial reports showing income, expenses, and savings. These reports help users analyze their financial status and plan future budgets.

The app is designed to be user-friendly and accessible, requiring no advanced technical knowledge.

---

&copy; **Michael Tvrdík 2025**, All rights reserved.

