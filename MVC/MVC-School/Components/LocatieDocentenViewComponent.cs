using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System.Linq;
using System.Threading.Tasks;

namespace MVC_School.Data
{
    public class LocatieDocentenViewComponent : ViewComponent
    {
        private readonly SchoolDbContext _context;

        public LocatieDocentenViewComponent(SchoolDbContext context)
        {
            _context = context;
        }

        public async Task<IViewComponentResult> InvokeAsync(int id)
        {
            var docenten = await _context.Docenten
                .Where(d => d.LocatieId == id)
                .ToListAsync();
            return View(docenten);
        }
    }
}
