using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Collections.Generic;

namespace MVC_School.Models
{
    public class Docent
    {
        public Docent()
        {
            Vakken = new HashSet<Vak>();
        }

        public int Id { get; set; }

        [StringLength(20)]
        public string Voornaam { get; set; }

        [StringLength(40)]
        public string Achternaam { get; set; }
        public string Naam => $"{Voornaam} {Achternaam}";

        [ForeignKey("Locatie")]
        public int LocatieId { get; set; }

        public virtual Locatie Locatie { get; set; }

        public ICollection<Vak> Vakken { get; set; }
    }
}
